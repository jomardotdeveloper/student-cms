@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="col-12">
        <a href="{{ route('grievances.print') }}" class="btn btn-primary">
            Print Summary Report
        </a>
    </div>
    @if ( auth()->user()->contact->role->complaints_read_write && auth()->user()->contact->role->is_committee)
        @if ($grievance->report)
        <div class="col-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete_employee_2">
                Edit Report
            </button>
        </div>
        <div class="modal custom-modal fade" id="delete_employee_2" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Submit Report</h3>
                        </div>
                        <form action="{{ route('grievances.update', ['grievance' => $grievance]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_summary_report" value="1">
                            <input type="hidden" name="is_update" value="1">
                            <div class="form-group">
                                <label for="">
                                    Body
                                </label>
                                <textarea name="body" id="body" class="form-control" cols="30" rows="10" required>{{ $grievance->report->body }} </textarea>
                            </div>

                            <input type="submit" value="Save" class="btn btn-primary mt-2"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete_employee">
                Submit Report
            </button>
        </div>
        @endif


    @endif

    <div class="modal custom-modal fade" id="delete_employee" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Submit Report</h3>
                    </div>
                    <form action="{{ route('grievances.update', ['grievance' => $grievance]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="is_summary_report" value="1">
                        <input type="hidden" name="is_create" value="1">
                        <div class="form-group">
                            <label for="">
                                Body
                            </label>
                            <textarea name="body" id="body" class="form-control" cols="30" rows="10" required></textarea>
                        </div>

                        <input type="submit" value="Save" class="btn btn-primary mt-2"/>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12 mt-2">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Grievance Form</h4>
                <p class="card-text">
                    View <code>grievance</code>
                </p>
            </div>
            <div class="card-body">

                <form action="#" method="POST" class="row" enctype="multipart/form-data">
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Student (Click to view Student Info)                           </label> <br>
                            <a href="{{ route('students.show', ['student' => $grievance->user->contact]) }}" style="font-size:20px;">{{ $grievance->user->contact->full_name }}</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Are you a student from PLM?                            </label>
                            <select name="is_student_plm" id="is_student_plm" class="form-control" disabled>
                                <option value="Yes" {{ $grievance->is_student_plm ? "selected" : "" }}>Yes</option>
                                <option value="No" {{ !$grievance->is_student_plm ? "selected" : "" }}>No</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>PLM Email</label>
                            <input class="form-control" type="email" name="plm_email" placeholder="PLM Email" value="{{ $grievance->plm_email }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Facebook Profile Link</label>
                            <input class="form-control" type="text" name="facebook" placeholder="FB Link" value="{{ $grievance->facebook }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Contact #</label>
                            <input class="form-control" type="text" name="contact_number" placeholder="Contact #" value="{{ $grievance->contact_number }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Course                       </label>
                            <select name="course" class="form-control" disabled>
                                <option value="BS ChE" {{ $grievance->course == "BS ChE" ? "selected" : "" }}>Bachelor of Science in Chemical Engineering - BS ChE</option>
                                <option value="BS CE" {{ $grievance->course == "BS CE" ? "selected" : "" }}>Bachelor of Science in Civil Engineering - BS CE</option>
                                <option value="BS CpE" {{ $grievance->course == "BS CpE" ? "selected" : "" }}>Bachelor of Science in Computer Engineering - BS CpE</option>
                                <option value="BS CS" {{ $grievance->course == "BS CS" ? "selected" : "" }}>Bachelor of Science in Computer Science - BS CS</option>
                                <option value="BS EE" {{ $grievance->course == "BS EE" ? "selected" : "" }}>Bachelor of Science in Electrical Engineering - BS EE</option>
                                <option value="BS ECE" {{ $grievance->course == "BS ECE" ? "selected" : "" }}>Bachelor of Science in Electronics Engineering - BS ECE</option>
                                <option value="BS IT" {{ $grievance->course == "BS IT" ? "selected" : "" }}>Bachelor of Science in Information Technology - BS IT</option>
                                <option value="BS MfE" {{ $grievance->course == "BS MfE" ? "selected" : "" }}>Bachelor of Science in Manufacturing Engineering - BS MfE</option>
                                <option value="BS ME" {{ $grievance->course == "BS ME" ? "selected" : "" }}>Bachelor of Science in Mechanical Engineering - BS ME</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Year                      </label>
                            <select name="year" class="form-control" disabled>
                                <option value="1" {{ $grievance->year == "1" ? "selected" : "" }}>1</option>
                                <option value="2" {{ $grievance->year == "2" ? "selected" : "" }}>2</option>
                                <option value="3" {{ $grievance->year == "3" ? "selected" : "" }}>3</option>
                                <option value="4" {{ $grievance->year == "4" ? "selected" : "" }}>4</option>
                                <option value="5" {{ $grievance->year == "5" ? "selected" : "" }}>5</option>
                                <option value="6" {{ $grievance->year == "6" ? "selected" : "" }}>6</option>
                                <option value="7" {{ $grievance->year == "7" ? "selected" : "" }}>7</option>
                                <option value="Irregular" {{ $grievance->year == "Irregular" ? "selected" : "" }}>Irregular</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Block                      </label>
                            <select name="block" class="form-control" disabled>
                                <option value="1" {{ $grievance->block == "1" ? "selected" : "" }}>1</option>
                                <option value="2" {{ $grievance->block == "2" ? "selected" : "" }}>2</option>
                                <option value="3" {{ $grievance->block == "3" ? "selected" : "" }}>3</option>
                                <option value="4" {{ $grievance->block == "4" ? "selected" : "" }}>4</option>
                                <option value="5" {{ $grievance->block == "5" ? "selected" : "" }}>5</option>
                                <option value="6" {{ $grievance->block == "6" ? "selected" : "" }}>6</option>
                                <option value="7" {{ $grievance->block == "7" ? "selected" : "" }}>7</option>
                                <option value="Irregular" {{ $grievance->block == "Irregular" ? "selected" : "" }}>Irregular</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>What is your concern?                      </label>
                            <select name="concern" class="form-control" disabled>
                                <option value="Academic Concern" {{ $grievance->concern == "Academic Concern" ? "selected" : "" }}>Academic Concern</option>
                                <option value="Non-academic Concern" {{ $grievance->concern == "Non-academic Concern" ? "selected" : "" }}>Non-academic Concern</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Subject of Concern                    </label>
                            <select name="subject_of_concern" class="form-control" disabled>
                                <option value="Enrollment" {{ $grievance->subject_of_concern == "Enrollment" ? "selected" : "" }}>Enrollment</option>
                                <option value="CRS" {{ $grievance->subject_of_concern == "CRS" ? "selected" : "" }}>CRS</option>
                                <option value="Synchronous and Asynchronous Class" {{ $grievance->subject_of_concern == "Synchronous and Asynchronous Class" ? "selected" : "" }}>Synchronous and Asynchronous Class</option>
                                <option value="Subject/Course-related" {{ $grievance->subject_of_concern == "Subject/Course-related" ? "selected" : "" }}>Subject/Course-related</option>
                                <option value="Shifting" {{ $grievance->subject_of_concern == "Shifting" ? "selected" : "" }}>Shifting</option>
                                <option value="Dropping out and/or filing Leave of Absence (LOA)" {{ $grievance->subject_of_concern == "Dropping out and/or filing Leave of Absence (LOA)" ? "selected" : "" }}>Dropping out and/or filing Leave of Absence (LOA)</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4" >
                            <label>Status                  </label>
                            <select name="status" class="form-control" disabled>
                                <option value="Pending" {{ $grievance->status == "Pending" ? "selected" : "" }}>Pending</option>
                                <option value="Ongoing" {{ $grievance->status == "Ongoing" ? "selected" : "" }}>Ongoing</option>
                                <option value="Unresponsive" {{ $grievance->status == "Unresponsive" ? "selected" : "" }}>Unresponsive</option>
                                <option value="Resolved" {{ $grievance->status == "Resolved" ? "selected" : "" }}>Resolved</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4" >
                            <label>Allowed Users                   </label>
                            <select disabled class="select-multiple form-control" name="allowed_users[]" multiple="multiple">
                                @foreach ($grievance->allowed_users as $user)

                                <option value="{{ $user->id }}" selected>{{ $user->contact->full_name }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>





                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                               Description of Concern
                            </label>
                            <textarea disabled name="description_of_concern" id="description_of_concern" class="form-control" cols="30" rows="10" required>{{$grievance->description_of_concern}}</textarea>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <label for="">Files</label> <br>
                        @foreach ($grievance->grievanceFiles as  $file)

                        <a href="{{ $file->file }}" class="mt-2" target="_blank">{{ $file->file }}</a>
                        @endforeach
                    </div>

                    <div class="col-12 mb-2">
                        <label for="">NLP Comment</label> <br>
                        <p>{{ $grievance->final_say }}</p>
                    </div>

                    @if (auth()->user()->contact->role->complaints_read_delete)
                    <div class="col-12">
                        <form action="{{ route('grievances.destroy', ['grievance' => $grievance]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Delete" class="btn btn-danger"/>
                        </form>
                    </div>

                    @endif
                </form>
            </div>
        </div>
    </div>
    @if ($grievance->status == "Resolved")
    <div class="col-sm-12 mt-2">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Rate Us</h4>
                <p class="card-text">
                    Rate <code>form</code>
                </p>
            </div>
            <div class="card-body">
                <form action="{{ route('grievances.update', ['grievance' => $grievance]) }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_rate_form" value="1"/>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Rate                      </label>
                            <select name="rate" class="form-control" required {{ $grievance->rate ? "disabled" : "" }}>
                                <option value="1" {{ $grievance->rate == "1" ? "selected" : "" }}>1</option>
                                <option value="2" {{ $grievance->rate == "2" ? "selected" : "" }}>2</option>
                                <option value="3" {{ $grievance->rate == "3" ? "selected" : "" }}>3</option>
                                <option value="4" {{ $grievance->rate == "4" ? "selected" : "" }}>4</option>
                                <option value="5" {{ $grievance->rate == "5" ? "selected" : "" }}>5</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                               Message ({{ $grievance->feedback ? $grievance->sentiment_analysis : "" }} )
                            </label>
                            <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="10" required {{ $grievance->feedback ? "disabled" : "" }}>{{ $grievance->feedback }}</textarea>
                        </div>
                    </div>

                    @if (!$grievance->feedback)
                    <div class="col-12">
                        <input type="submit" value="Save" class="btn btn-primary"/>
                    </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
    @endif

</div>

<div class="row mt-2">
    @if (auth()->user()->contact->role->complaints_read_write &&  auth()->user()->contact->role->access_to_message)
    <div class="col-12 mb-2">
        <a href="{{ route('emails.create') }}?grievance_id={{ $grievance->id }}&&message_type={{ auth()->user()->contact->role->is_committee ? "Student" : "Committee"  }}" class="btn btn-primary">
            Send Message to {{ auth()->user()->contact->role->is_committee ? "Student" : "Committee"  }}
        </a>
    </div>
    @endif

    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Messages</h4>
                <p class="card-text">
                    Conversation <code>grievance</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Read</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($emails as $email)
                            <tr>
                                <td>{{ $email->from_user->contact->full_name }}</td>
                                <td>{{ $email->to_user->contact->full_name }}</td>
                                <td>{{ $email->subject }}</td>
                                <td>{{ $email->created_at }}</td>
                                <td class="{{ $email->is_read ? "text-success" : "text-danger" }}">{{ $email->is_read ? "Yes" : "No" }}</td>
                                <td>
                                    <a href="{{ route('emails.show', $email->id) }}" class="btn btn-primary btn-sm">Show</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
