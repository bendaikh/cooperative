/**
 * Decimal Quantity Validation Utility
 * Provides real-time validation for decimal quantities with stock availability checks
 */

/**
 * Format a number to specific decimal places
 * @param {number} value - The value to format
 * @param {number} decimals - Number of decimal places (default: 3)
 * @returns {string} Formatted number
 */
function formatQuantity(value, decimals = 3) {
    return parseFloat(value).toFixed(decimals);
}

/**
 * Validate quantity is numeric and positive
 * @param {string|number} quantity - The quantity to validate
 * @returns {object} { isValid: boolean, error: string }
 */
function validateQuantityFormat(quantity) {
    const num = parseFloat(quantity);
    
    if (isNaN(num)) {
        return { isValid: false, error: 'Veuillez entrer une valeur numérique valide' };
    }
    
    if (num <= 0) {
        return { isValid: false, error: 'La quantité doit être supérieure à 0' };
    }
    
    if (num > 999999.999) {
        return { isValid: false, error: 'La quantité dépasse la limite maximale' };
    }
    
    return { isValid: true, error: null };
}

/**
 * Validate quantity against available stock
 * @param {number} requested - Requested quantity
 * @param {number} available - Available quantity in stock
 * @param {string} unit - Unit of measurement (e.g., 'kg', 'unités')
 * @returns {object} { isValid: boolean, error: string }
 */
function validateStockAvailability(requested, available, unit = 'kg') {
    const reqNum = parseFloat(requested);
    const availNum = parseFloat(available);
    
    // First validate format
    const formatCheck = validateQuantityFormat(requested);
    if (!formatCheck.isValid) {
        return formatCheck;
    }
    
    if (reqNum > availNum) {
        return {
            isValid: false,
            error: `Stock insuffisant (disponible : ${formatQuantity(availNum, 3)} ${unit})`
        };
    }
    
    return { isValid: true, error: null };
}

/**
 * Setup real-time validation on a quantity input field
 * @param {HTMLInputElement} inputElement - The input element to validate
 * @param {HTMLElement} errorElement - The element to display errors
 * @param {function} customValidator - Optional custom validation function
 */
function setupQuantityValidation(inputElement, errorElement, customValidator = null) {
    if (!inputElement || !errorElement) return;
    
    const handler = function() {
        let validation = validateQuantityFormat(inputElement.value);
        
        // Run custom validator if provided
        if (validation.isValid && customValidator) {
            validation = customValidator(inputElement.value);
        }
        
        // Update error display
        if (validation.error) {
            errorElement.textContent = validation.error;
            errorElement.style.display = 'block';
            inputElement.style.borderColor = '#dc2626';
        } else {
            errorElement.textContent = '';
            errorElement.style.display = 'none';
            inputElement.style.borderColor = '#d1d5db';
        }
        
        return validation.isValid;
    };
    
    // Listen to input events for real-time validation
    inputElement.addEventListener('input', handler);
    inputElement.addEventListener('change', handler);
    inputElement.addEventListener('blur', handler);
}

/**
 * Setup stock availability checker on quantity input
 * @param {HTMLInputElement} quantityInput - The quantity input element
 * @param {HTMLElement} errorElement - The error message element
 * @param {number} availableStock - Available quantity in stock
 * @param {string} unit - Unit of measurement
 */
function setupStockAvailabilityCheck(quantityInput, errorElement, availableStock, unit = 'kg') {
    setupQuantityValidation(
        quantityInput,
        errorElement,
        (value) => validateStockAvailability(value, availableStock, unit)
    );
}

// Export for use in modules or include globally
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        formatQuantity,
        validateQuantityFormat,
        validateStockAvailability,
        setupQuantityValidation,
        setupStockAvailabilityCheck
    };
}
