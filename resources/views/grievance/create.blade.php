@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
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
                    Create <code>grievance</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('grievances.store') }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf

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

                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">Terms of Agreement and Data Privacy Consent                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    I acknowledge that I have read, and do hereby accept the Terms of Agreement and Data Privacy Policy contained in this form.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    I acknowledge that I have read, and do hereby not accept the Terms of Agreement and Data Privacy Policy contained in this form.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Are you a student from PLM?                            </label>
                            <select name="is_student_plm" id="is_student_plm" class="form-control" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>PLM Email</label>
                            <input class="form-control" type="email" name="plm_email" placeholder="PLM Email" >
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Facebook Profile Link</label>
                            <input class="form-control" type="text" name="facebook" placeholder="FB Link" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Contact #</label>
                            <input class="form-control" type="text" name="contact_number" placeholder="Contact #" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Course                       </label>
                            <select name="course" class="form-control" required>
                                <option value="BS ChE">Bachelor of Science in Chemical Engineering - BS ChE</option>
                                <option value="BS CE">Bachelor of Science in Civil Engineering - BS CE</option>
                                <option value="BS CpE">Bachelor of Science in Computer Engineering - BS CpE</option>
                                <option value="BS CS">Bachelor of Science in Computer Science - BS CS</option>
                                <option value="BS EE">Bachelor of Science in Electrical Engineering - BS EE</option>
                                <option value="BS ECE">Bachelor of Science in Electronics Engineering - BS ECE</option>
                                <option value="BS IT">Bachelor of Science in Information Technology - BS IT</option>
                                <option value="BS MfE">Bachelor of Science in Manufacturing Engineering - BS MfE</option>
                                <option value="BS ME">Bachelor of Science in Mechanical Engineering - BS ME</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Year                      </label>
                            <select name="year" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="Irregular">Irregular</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Block                      </label>
                            <select name="block" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="Irregular">Irregular</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>What is your concern?                      </label>
                            <select name="concern" class="form-control">
                                <option value="Academic Concern">Academic Concern</option>
                                <option value="Non-academic Concern">Non-academic Concern</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Subject of Concern                    </label>
                            <select name="subject_of_concern" class="form-control">
                                <option value="Enrollment">Enrollment</option>
                                <option value="CRS">CRS</option>
                                <option value="Synchronous and Asynchronous Class">Synchronous and Asynchronous Class</option>
                                <option value="Subject/Course-related">Subject/Course-related</option>
                                <option value="Shifting">Shifting</option>
                                <option value="Dropping out and/or filing Leave of Absence (LOA)">Dropping out and/or filing Leave of Absence (LOA)</option>
                            </select>


                        </div>
                    </div>





                    @if (auth()->user()->contact->role->is_committee)
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Status                  </label>
                            <select name="status" class="form-control" required>
                                <option value="Pending">Pending</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Unresponsive ">Unresponsive</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Allowed Users                   </label>
                            <select class="select-multiple form-control" name="allowed_users[]" multiple="multiple">
                                @foreach ($users as $user)

                                <option value="{{ $user->id }}">{{ $user->contact->full_name }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>

                    @endif





                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                                Please provide narrative details of your Concern, Query, Complaint, and/or Grievance. <br>
                                If your concern has already been resolved after you have answered this form, please contact the Ambassadors for Students' Protection and Case Assistance via contact number, email, or Messenger.
                            </label>
                            <textarea name="description_of_concern" id="description_of_concern" class="form-control" cols="30" rows="10" required></textarea>
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
