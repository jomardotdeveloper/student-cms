@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12">
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
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
                <h4 class="card-title mb-0">Grievance Form</h4>
                <p class="card-text">
                    Edit <code>grievance</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('grievances.update', ['grievance' => $grievance]) }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h4>Greetings in the spirit of student welfare!</h4>
                    <p>
                        As a primary step in developing concrete resolutions to problems that every Knight may feel burdened with, the Student Assistance and Grievance Help Desk (STAGHD) of the PLM College of Engineering - Student Council (CEng-SC) formally launches this form to collect the academic and non-academic concerns, queries, grievances, and complaints of PLM CEng students for the Academic Year 2023-2024
                    </p>
                    <p>
                        Students may fill out and submit their concerns in this form. Within 2-3 days after answering, the PLM CEng-SC Academic Affairs, and Students' Rights and Welfare (STRAW) committees will send an email or communicate through other contact details provided by the students.
                    </p>
                    <p>
                        Kindly note that the name and photo associated with the Google account used to answer the form will be recorded upon uploading of files and submitting.
                    </p>
                    <p>
                        If you need further assistance in answering the CEng-SC Student Assistance and Grievance Help Desk (STAGHD) Form, you may contact the following:
                    </p>
                    <p>
                        Elijah Mae S. Pajarillo <br>
                        Ambassador for Students' Protection and Case Assistance <br>
                        09760393399 <br>
                        elijahpajarillo1254@gmail.com
                    </p>
                    <p>
                        Eunice Marian J. Salcedo <br>
                        Ambassador for Students' Protection and Case Assistance <br>
                        09063336091 <br>
                        eunicemariansalcedo@gmail.com
                    </p>
                    <p>
                        John Nhilsan I. De Mesa <br>
                        Ambassador for Students' Protection and Case Assistance <br>
                        09686386374 <br>
                        nhilsandemesa32@gmail.com
                    </p>
                    <h4>
                        Terms of Agreement
                    </h4>
                    <p>
                        By filling out this form, you consent to these Terms of Agreement and to the exclusive jurisdictions of legitimate natural and juridical entities in all inquiries, complaints, and grievances arising out of such access. To read the Terms of Agreement, please open this
                        <br>URL:<br> https://docs.google.com/document/d/1taHmKmJGDhNandCrpIBm_zB6YWIAhqoGwl8PaqZ6A-o/edit?usp=sharing
                    </p>
                    <h4>
                        Data Privacy Policy
                    </h4>
                    <p>
                        We value and protect your personal information in compliance with the Data Privacy Act of 2012 (RA 10173). Personal information includes any information such as Name, Year & Course, Contact Number, Student Number, Email Address, and Concern. All data will be kept secure and confidential by the PLM College of Engineering - Student Council Students' Rights and Welfare and Academe Affairs Committee only. The information will serve as a reference for communication. Any personal information will not be disclosed without your consent. <br> URL: <br> https://docs.google.com/document/d/1-_CJqPbIQKZFz1zHVvRrgVOx-Iuu-AurXz6_gqCEMSA/edit?usp=sharing
                    </p>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Are you a student from PLM?                            </label>
                            <select name="is_student_plm" id="is_student_plm" class="form-control" required>
                                <option value="Yes" {{ $grievance->is_student_plm ? "selected" : "" }}>Yes</option>
                                <option value="No" {{ !$grievance->is_student_plm ? "selected" : "" }}>No</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>PLM Email</label>
                            <input class="form-control" type="email" name="plm_email" placeholder="PLM Email" value="{{ $grievance->plm_email }}" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Facebook Profile Link</label>
                            <input class="form-control" type="text" name="facebook" placeholder="FB Link" value="{{ $grievance->facebook }}" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Contact #</label>
                            <input class="form-control" type="text" name="contact_number" placeholder="Contact #" value="{{ $grievance->contact_number }}" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Course                       </label>
                            <select name="course" class="form-control" required>
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
                            <select name="year" class="form-control">
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
                            <select name="block" class="form-control">
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
                            <select name="concern" class="form-control">
                                <option value="Academic Concern" {{ $grievance->concern == "Academic Concern" ? "selected" : "" }}>Academic Concern</option>
                                <option value="Non-academic Concern" {{ $grievance->concern == "Non-academic Concern" ? "selected" : "" }}>Non-academic Concern</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Subject of Concern                    </label>
                            <select name="subject_of_concern" class="form-control">
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
                        <div class="form-group mb-4">
                            <label>Status                  </label>
                            <select name="status" class="form-control" required>
                                <option value="Pending" {{ $grievance->status == "Pending" ? "selected" : "" }}>Pending</option>
                                <option value="Ongoing" {{ $grievance->status == "Ongoing" ? "selected" : "" }}>Ongoing</option>
                                <option value="Unresponsive" {{ $grievance->status == "Unresponsive" ? "selected" : "" }}>Unresponsive</option>
                                <option value="Resolved" {{ $grievance->status == "Resolved" ? "selected" : "" }}>Resolved</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Allowed Users                   </label>
                            <select class="select-multiple form-control" name="allowed_users[]" multiple="multiple">
                                @foreach ($users as $user)

                                <option value="{{ $user->id }}" {{ in_array($user->id, $grievance->allowed_user_ids) ? "selected" : "" }}>{{ $user->contact->full_name }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>





                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                                Please provide narrative details of your Concern, Query, Complaint, and/or Grievance. <br>
                                If your concern has already been resolved after you have answered this form, please contact the Ambassadors for Students' Protection and Case Assistance via contact number, email, or Messenger.
                            </label>
                            <textarea name="description_of_concern" id="description_of_concern" class="form-control" cols="30" rows="10" required>{{$grievance->description_of_concern}}</textarea>
                        </div>
                    </div>

                    <div class="col-8 mb-2">
                        <div class="form-group">
                            <label for="">Upload files or evidences to support your concern (optional) <br>
                                The document file to be submitted may contain supporting images or any documents that are raw or not edited. Provide the link/s of other supporting document/s, video/s, or any materials to be attached in the Document if there are any. FILE NAME: Surname_SubjectofConcern

                            </label>
                            <input type="file" name="files[]" id="files" class="form-control" multiple>

                        </div>
                    </div>


                    <div class="col-12">
                        <input type="submit" value="Save" class="btn btn-primary"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
