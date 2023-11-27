@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12">
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach(Session::get('error') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>

        @endif
    </div>
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Compose</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('emails.store') }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf
                    @php
                        $messageType = "Student";

                        if (isset($_GET['message_type'])) {
                            $messageType = $_GET['message_type'];
                        }
                    @endphp
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Message Type</label>
                            <select name="message_type" id="message_type" class="form-control" required>
                                <option value="Student" {{ $messageType == "Student" ? "selected" : "" }}>Student</option>
                                <option value="Admin" {{ $messageType == "Admin" ? "selected" : "" }}>Admin</option>
                                <option value="Committee" {{ $messageType == "Committee" ? "selected" : "" }}>Committee</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Grievance</label>
                            <select name="grievance_id" id="grievance_id" class="form-control" required>
                                <option value="">Select Grievance</option>
                                @php
                                    $grievance_id = null;
                                    $current_grievance = null;
                                    if(isset($_GET['grievance_id'])) {
                                        $grievance_id = $_GET['grievance_id'];
                                        $current_grievance = \App\Models\Grievance::find($grievance_id);
                                    }
                                @endphp
                                @foreach ($grievances as $grievance)
                                <option value="{{ $grievance->id }}" {{ $grievance_id == $grievance->id ? "selected" : "" }}>{{ $grievance->formatted_id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if ($messageType == "Committee")

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Committee</label>
                            <select name="user_id" id="user_id" class="form-control" required>

                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" >{{ $user->contact->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if ($messageType == "Student")
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Student #</label>
                            <input class="form-control" type="text" name="student_number" value="{{ $current_grievance ? $current_grievance->user->contact->student_number : "" }}" placeholder="Student #" required>
                        </div>
                    </div>
                    @endif


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Subject</label>
                            <input class="form-control" type="text" name="subject" placeholder="Subject" value="{{ $current_grievance ? "Grievance #" . $current_grievance->formatted_id : ''  }}" required>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                                Body
                            </label>
                            <textarea name="body" id="body" class="form-control" cols="30" rows="10" required></textarea>
                        </div>
                    </div>

                    <div class="col-8 mb-2">
                        <div class="form-group">
                            <label for="">Attachments
                            </label>
                            <input type="file" name="files[]" id="files" class="form-control" multiple>

                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"><span>Send</span> <i class="fa-solid fa-paper-plane m-l-5"></i></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var messageType = document.getElementById('message_type');

    messageType.addEventListener('change', function() {
        window.location.href = "{{ route('emails.create') }}" + "?message_type=" + messageType.value;
    });
</script>
@endsection
