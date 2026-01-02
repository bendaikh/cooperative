<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\FilledCapsule;
use App\Models\Herb;

class CommandeErrorsAndStatusTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test that validation errors are properly displayed on form submission
     */
    public function test_validation_errors_are_displayed_on_form_submission(): void
    {
        // Get a client
        $client = Client::first() ?? Client::factory()->create(['name' => 'Test Client']);
        
        // Try to submit form with missing required fields
        $response = $this->post(route('commandes.store'), [
            'client_id' => $client->id,
            // Missing all other required fields
        ]);

        // Should redirect back with errors
        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }

    /**
     * Test that status update works correctly
     */
    public function test_status_update_from_confirme_to_emballage(): void
    {
        // Create a commande with Confirmé status
        $commande = Commande::factory()->create(['status' => 'Confirmé']);
        
        // Update status to En cours d'emballage
        $response = $this->postJson(route('commandes.update-status', $commande->id), [
            'status' => 'En cours d\'emballage'
        ]);

        // Should succeed
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        
        // Verify status was updated
        $this->assertDatabaseHas('commandes', [
            'id' => $commande->id,
            'status' => 'En cours d\'emballage'
        ]);
    }

    /**
     * Test that invalid status returns error
     */
    public function test_invalid_status_returns_error(): void
    {
        $commande = Commande::factory()->create(['status' => 'Confirmé']);
        
        // Try to update with invalid status
        $response = $this->postJson(route('commandes.update-status', $commande->id), [
            'status' => 'Invalid Status'
        ]);

        // Should return 422 (validation error)
        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Erreur de validation'
        ]);
        
        // Status should not have changed
        $this->assertDatabaseHas('commandes', [
            'id' => $commande->id,
            'status' => 'Confirmé'
        ]);
    }

    /**
     * Test that cannot go backwards in status
     */
    public function test_cannot_change_status_backwards(): void
    {
        $commande = Commande::factory()->create(['status' => 'En cours d\'emballage']);
        
        // Try to go back to Confirmé
        $response = $this->postJson(route('commandes.update-status', $commande->id), [
            'status' => 'Confirmé'
        ]);

        // Should fail
        $response->assertStatus(400);
        $response->assertJson(['success' => false]);
        
        // Status should remain unchanged
        $this->assertDatabaseHas('commandes', [
            'id' => $commande->id,
            'status' => 'En cours d\'emballage'
        ]);
    }

    /**
     * Test that cannot modify commande that is Sortie
     */
    public function test_cannot_modify_sortie_commande(): void
    {
        $commande = Commande::factory()->create(['status' => 'Sortie']);
        
        // Try to change status
        $response = $this->postJson(route('commandes.update-status', $commande->id), [
            'status' => 'En cours d\'emballage'
        ]);

        // Should fail
        $response->assertStatus(400);
        $response->assertJson(['success' => false]);
    }
}
