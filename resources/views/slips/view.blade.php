<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

    <style>
        table {
            width:100%;
        }

        .container{

        }
        .header{
            text-align: center;
        }

        
        @media print {
            table{
                border:1px solid black;
            }
        }

    </style>
</head>
<body>

    <div class="container">
        <h1 class="header">Ejaz Sikandar Memorial Hospital Kangan Pur</h1>
        <table border="1px solid black">
            <tr>
                <td>MR No: {{ $slip->patient->mr_number }}</td>
                <td>Bill No: {{ $slip->slip_number }}</td>
                <td>Time: {{ $slip->created_at->format('h:i A') }}</td>
                <td>Date: {{ $slip->created_at->format('d-M-Y') }}</td>
                <td>CNIC: {{ $slip->patient->cnic }}</td>
            </tr>
            <tr>
                <td colspan="2">Pt. Name: {{ $slip->patient->name }}</td>
                
                <td colspan="2">W/O:</td>
                
                <td>BP:</td>
            </tr>
            <tr>
                <td>Age: {{ $slip->patient->age_years }}y, {{ $slip->patient->age_months }}m, {{ $slip->patient->age_weeks }}w</td>
                <td>Gender: {{ $slip->patient->gender }}</td>
                <td colspan="2">Contact: {{ $slip->patient->phone }}</td>
                <td>Weight</td>
            </tr>
    
            <tr>
                <td colspan="2" rowspan="3">Presenting Complaint &<br>Relevent History</td>
                
                <td colspan="2" rowspan="3">Address</td>
            
                <td>Temp:</td>
            </tr>
    
            <tr>
                
                
                
                
                <td>Pulse:</td>
            </tr>
    
            <tr>
                
                
                
                
                <td>Spo2:</td>
            </tr>
    
            <tr>
                <td colspan="2">Physician: Dr. {{ $slip->doctor ? $slip->doctor->user->full_name : '-' }}</td>
                
                <td colspan="2">Fee Paid: {{ $slip->total_amount }}</td>
                
                <td>Advice By Dr: </td>
            </tr>
    
    
        </table>
    </div>
	

</body>
</html>