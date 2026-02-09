<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<meta charset="UTF-8">
	<title>بلاغ للبيت بخصوص التجمع</title>
	<style>
		body {
			font-family: "Arial", sans-serif;
			direction: rtl;
			background: #fff;
			margin: 24px 20px 30px;
			color: #1f2a44;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 10px;
		}
		th, td {
			border: 1px solid #1f4e79;
			padding: 6px 8px;
			vertical-align: middle;
			font-size: 14px;
		}
		.no-border {
			border: none;
		}
		.center {
			text-align: center;
		}
		.title {
			font-size: 18px;
			font-weight: bold;
		}
		.subtitle {
			font-size: 16px;
			font-weight: bold;
		}
		.code-box {
			width: 90px;
			font-weight: bold;
		}
		.issue-box {
			width: 90px;
			font-weight: bold;
		}
		.logo-box {
			width: 120px;
		}
		.top-line {
			border-top: 1px solid #1f4e79;
		}
		.lines {
			height: 520px;
			padding: 10px;
			word-break: break-word;
			white-space: pre-wrap;
			font-size: 13px;
		}
		.footer {
			margin-top: 20px;
			font-weight: bold;
		}
		.signature-line {
			height: 80px;
			border-top: 1px solid #000;
			margin-top: 40px;
		}

		@media print {
			body {
				margin: 0;
				padding: 0;
			}
			table {
				page-break-inside: avoid;
			}
		}
	</style>
</head>
<body>

	<!-- HEADER -->
	<table>
		<tr>
			<td rowspan="2" class="center logo-box">
				@if(file_exists(public_path('logo.svg')))
					<img src="{{ asset('logo.svg') }}" alt="Logo" style="max-width: 100px; height: auto;">
				@endif
			</td>
			<td rowspan="2" class="center title">
				استمارة:<br>
				بلاغ للبيت بخصوص التجمع
			</td>
			
			<td class="center code-box"><b>الرمز</b></td>
            <td class="center code-box"><b>PR-R-FR3</b></td>
		</tr>
		<tr>
			<td class="center issue-box"><b>الإصدار</b></td>
			<td class="center issue-box"><b>01</b></td>
		</tr>
	</table>

	<!-- FILE INFO -->
	<table>
		<tr>
			<th>فتح بتاريخ:</th>
			<td>{{ $document->content['file_date'] ?? '' }}</td>
			<th>ملف رقم:</th>
			<td>{{ $document->content['file_number'] ?? '' }}</td>
		</tr>
	</table>

	<!-- LINED AREA -->
	<table>
		<tr>
			<td class="lines" style="text-align: right; vertical-align: top;">{{ $document->content['notes'] ?? '' }}</td>
		</tr>
	</table>

	<div class="footer">توقيع مدير المؤسسة:</div>
	<div class="signature-line"></div>

</body>
</html>
