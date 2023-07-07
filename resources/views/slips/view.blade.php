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
        #goback {
            margin-top: 10px;
            display: block;
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



    </style>
</head>
<body>

    <div class="container">
    <div id="goback">
        <a href="{{ url()->previous() }}">Go Back</a>
    </div>
        <h1 class="header">Ejaz Sikandar Memorial Hospital Kangan Pur</h1>
        <table border="1px solid black">
            <tr>
                <td>MR No: {{ $slip->patient->mr_number }}</td>
                <td>Bill No: Slip#{{ $slip->slip_number }}</td>
                <td>Time: {{ $slip->created_at->format('h:i A') }}</td>
                <td>Date: {{ $slip->created_at->format('d-M-Y') }}</td>
                <td>CNIC: {{ $slip->patient->cnic }}</td>
            </tr>
            <tr>
                <td colspan="2">Pt. Name: {{ $slip->patient->name }}</td>
                
                <td colspan="2">{{ $slip->patient->W_O ? 'W/O: ' .$slip->patient->W_O : ($slip->patient->D_O ? 'D/O: '. $slip->patient->D_O : ($slip->patient->S_O ? 'S/O: '.  $slip->patient->S_O : ''))}}</td>
                
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
                
                <td colspan="2" rowspan="3">Address: {{ $slip->patient->address}}</td>
            
                <td>Temp:</td>
            </tr>
    
            <tr>
                
                
                
                
                <td>Pulse:</td>
            </tr>
    
            <tr>
                
                
                
                
                <td>Spo2:</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2">Patient History: {{ $slip->description }}</td>
                <td colspan="2">Procedures:
                                    @foreach($slip->procedures as $item)
                                    {{ $item->name }},
                                    @endforeach
                                </td>
                <td>Doctor_type: {{$slip->doctor_type}}</td>

            </tr>
            <tr>
                
            </tr>
            <tr>
                <td colspan="2">Physician: Dr. {{ $slip->doctor ? $slip->doctor->user->full_name : '-' }}</td>
                
                <td colspan="2">Fee Paid: Rs.{{ $slip->total_amount }}</td>
                
                <td>Advice By Dr: </td>
            </tr>
            
    
    
        </table>

        <div style="display:flex; justify-content:space-between;margin-top:20px;">
            <p>Doctor Sign ___________</p>
            <p>Receptionist Sign ___________</p>
        </div>
    </div>
	



</body>
</html>