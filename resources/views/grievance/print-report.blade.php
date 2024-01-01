<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 style="text-align: center;">Letter of Grievance to the Office of Students’ Development and Services (OSDS)</h2>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>TO : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prof. Vilma Dela Cruz</h5>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Acting Dean, Office of Students’ Development and Services (OSDS)</p>
    </div>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>THROUGH : Prof. Raymund Dioses</h5>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;College Grievance Head Committee</p>
    </div>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>FROM : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COE-SC STRAW Committee</h5>
    </div>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>COLLEGE : &nbsp;College of Engineering</h5>
    </div>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>SUBJECT : </h5>
    </div>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>DATE :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;{{  date('m/d/Y') }}</h5>
    </div>
    <hr>
    <h5 style="text-align:center;">Narrative</h5>
    <p style="text-align: center;">{{ $grievance->description_of_concern }}</p>
    <br>
    <br>
    <br>
    <h5 style="text-align:center;">Policies Subject for Violation</h5>
    <p style="text-align: center;">{{ $grievance->report->body }}</p>
    <br>
    <br>
    <br>
    <h5 style="text-align:center;">Annexes</h5>
    <p style="text-align: center;"></p>
    <p style="page-break-before: always"/>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    &nbsp;
    <br>
    <br>
    <br>
    &nbsp;
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>Prepared by : {{ $grievance->user->contact->full_name }}</h5>
    </div><br><br><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <p><i>Ambassador for Grievance, COE SC STRAW</i></p>
    </div><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        Cristine Delfin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cedric Paynor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maggie Reantillo<br><br><br>
        Anne Krishane Calisay&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Racelito Pascual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Justine Kylle Rodriguez
    </div>
    <p style="page-break-before: always"/>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <h5>Approved by : </h5>
        <p>Engr. Perferinda Caubang</p>
        <p><i>COE SC Adviser</i></p>
    </div><br><br><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <p><i>COE SC STRAW Head</i></p>
    </div><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        Monique Irabagon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Redrick Gregorion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jastine De Guzman
    </div><br><br><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <p><i>COE SC STRAW Ambassador for Research and Affairs</i></p>
    </div><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        Ashney Khan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stiffany Losa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jerome Peralta
    </div><br><br><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        <p><i>COE SC STRAW Ambassador for Students’ Protection and Case Assistance</i></p>
    </div><br>
    <div style="padding-left:1rem;padding-right:1rem; margin-left:1rem;">
        John De Mesa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Elijah Parajillo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Patricia Sala&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eunice Salcedo
    </div><br><br><br>
</body>
<script>
    window.print();
</script>
</html>
