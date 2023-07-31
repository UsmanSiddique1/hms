<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		table, td, th {
		  border: 1px solid black;
		}
		.table2 {
		  border-collapse: collapse;
		}

		@media print {
            table{
                border:1px solid black;
            }
            #goback {
                display: none;
            }
            @page {
                size: auto;  /* Set the page size to auto to remove the URL header */
                margin-top: 0;  /* Set the top margin to 0 to remove any extra space */
            }

            /* Hide the header section that includes the URL */
            @page :first {
                header: none;
            }
        }

        #goback a{
            background: skyblue;
            border-radius: 10px;
            padding: 10px 20px;
            color: white;
        }

		.header{
            text-align: center;
        }
        #goback {
            margin-top: 10px;
            display: block;
        }

	</style>
</head>
<body>
	<div id="goback">
        <a href="{{ url()->previous() }}">Go Back</a>
    </div>
        <h1 class="header">Ejaz Sikandar Memorial Hospital Kangan Pur</h1>
        <h5>{{$slip->type}}</h5>
	<div style="display: flex;">

		<div style="width: 65%;">
			<table class="table2" style="width: 100%;">
				<tr>
					<td>MR No: <span>{{ $slip->patient->mr_number }}</span></td>
					<td>Date: <span>{{ $slip->created_at->format('d-M-Y') }}</span></td>
					<td colspan="2">Time: <span>{{ $slip->created_at->format('h:i A') }}</span></td>
				</tr>
				<tr>
					<td>Pt. Name: <span>{{ $slip->patient->name }}</span></td>
					<td>{{ $slip->patient->W_O ? 'W/O: ' .$slip->patient->W_O : ($slip->patient->D_O ? 'D/O: '. $slip->patient->D_O : ($slip->patient->S_O ? 'S/O: '.  $slip->patient->S_O : ''))}}</td>
					<td>Age: <span>{{ $slip->patient->age_years }}y, {{ $slip->patient->age_months }}m, {{ $slip->patient->age_days }}d</span></td>
					<td>Gender: <span>{{ $slip->patient->gender }}</span></td>
				</tr>
				<tr>
					<td>Contact: <span>{{ $slip->patient->phone }}</span></td>
					<td>CNIC: <span>{{ $slip->patient->cnic }}</span></td>
					<td colspan="2">Address: <span>{{ $slip->patient->address}}</span></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: center;"><u><b>Doner</b></u></td>

				</tr>
				<tr>
					<td>Pt. Name: <span>{{ $slip->donor->name }}</span></td>
					<td>S/O: <span>{{ $slip->donor->S_O }}</span></td>
					<td>Age: <span>{{ $slip->donor->age }}</span></td>
					<td>Gender: <span>{{ $slip->donor->gender }}</span></td>
				</tr>
				<tr>
					<td>Contact: <span>{{ $slip->donor->phone }}</span></td>
					<td>CNIC: <span>{{ $slip->donor->cnic }}</span></td>
					<td colspan="2">Address: <span>{{ $slip->donor->address }}</span></td>
				</tr>
			</table>
			<h4>Advice By: Dr. {{ $slip->doctor ? $slip->doctor->user->full_name : '-' }}</h4>
			<h4>Lab Consultant Signs: _______ &nbsp; &nbsp; Accountant: ________</h4>

			<div style="padding: 5px 10px 5px 10px; border: 1px solid black; border-radius: 10px;">
				<h3> Note: - This slip issue on the behalf of the fee paid</h3>
			</div>

		</div>

		<div style="width: 35%;">
			<table style="width:100%" class="table2">
				@foreach($slip->procedures as $item)
				<tr>
					<td style="width: 70px;">Test</td>
					<td style="width: 30px;">{{ $item->name }}</td>
				</tr>
				@endforeach			
				<tr>
					<td style="width: 70px;">Total</td>
					<td style="width: 30px;">Rs.{{ $slip->grand_total }} {{ $slip->discount > 0 ? 'Discount: Rs'. $slip->discount : '' }}</td>
				</tr>
				
			</table>
		</div>
	</div>

</body>
</html>