<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-light p-5 rounded-lg m-3">
                    <h1 class="display-4 text-center">Ejaz Sikandar Memorial Hospital</h1>
                    <p class="lead"> Slip Type <span class="badge badge-primary">{{ $slip->type }}</span></p>
                    <p class="lead"> Price: <b>Rs.{{ $slip->total_amount }}</b></p>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Patient Details</h3>
                            <p>Name: {{ $slip->patient->name }}</p>
                            <p>phone: {{ $slip->patient->phone }}</p>
                            <p>age: {{ $slip->patient->age }}</p>
                            <p>gender: {{ $slip->patient->gender }}</p>
                            <h5>MR Number: {{ $slip->patient->mr_number }}</h5>

                            
                        </div>
                        <div class="col-md-6">
                            <h4>Doctor Details</h3>
                            <p>Name: {{ $slip->doctor ? $slip->doctor->user['f_name'] : 'null' }}</p>
                            <p>speciality: {{ $slip->doctor ? $slip->speciality : 'null' }}</p>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>