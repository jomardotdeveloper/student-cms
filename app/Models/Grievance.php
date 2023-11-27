<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sentiment\Analyzer;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Similarity\CosineSimilarity;
class Grievance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_student_plm',
        'plm_email',
        'facebook',
        'contact_number',
        'course',
        'year',
        'block',
        'concern',
        'subject_of_concern',
        'description_of_concern',
        'allowed_users',
        'rate',
        'feedback',
        'status',
    ];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grievanceFiles()
    {
        return $this->hasMany(GrievanceFile::class);
    }

    public function getAllowedUsersAttribute()
    {
        $users = [];

        if (!$this->attributes['allowed_users']) {
            return [];
        }

        foreach (json_decode($this->attributes['allowed_users']) as $user) {
            $users[] = User::find($user);
        }
        return $users;
    }

    public function getAllowedUserIdsAttribute()
    {
        if (!$this->attributes['allowed_users']) {
            return [];
        }
        return json_decode($this->attributes['allowed_users']);
    }

    public function getFormattedIdAttribute()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }


    public function getSentimentAnalysisAttribute()
    {
        $analyzer = new Analyzer();
        $output_text = $analyzer->getSentiment($this->feedback);
        $mood = '';

        $moods = [
            'Negative - ' . strval($output_text['neg'] * 100) . '%',
            'Neutral - ' . strval($output_text['neu'] * 100) . '%',
            'Positive - ' . strval($output_text['pos'] * 100) . '%',
        ];


        if($output_text['neg'] > 0){
            $mood = 'Negative';
        }

        if($output_text['neu'] > 0 && $output_text['neg'] == 0){
            $mood = 'Neutral';

        }

        if($output_text['pos'] > 0){
            $mood = 'Positive';
        }

        $moods_str = implode(', ', $moods);
        return $moods_str;
    }


    public function getFinalSayAttribute()
    {
        // Sample complaint text (you can replace this with your complaint text)
        $complaint = $this->description_of_concern;

        // Policy text - Example: V. GUIDELINES ON ONLINE LEARNING FOR STUDENTS WITH INTERNET...
        $policyText = "V. GUIDELINES ON ONLINE LEARNING FOR STUDENTS WITH INTERNET
        CONNECTIVITY AND ACCESS TO COMPUTER GADGETS
        A. GENERAL GUIDELINES IN THE CONDUCT OF ONLINE CLASSES
        1. Only the approved Learning Management System (LMS) of the University shall be used by
        faculty members in the conduct of their online classes.
        2. Both synchronous and asynchronous modes of learning delivery can be used for all online
        classes, at the discretion of faculty members and in the exercise of their academic freedom.
        In synchronous learning, faculty members may use either Zoom or MS Teams. In asynchronous
        learning, on the other hand, faculty members shall use the MS Teams where they can upload
        their learning materials, whether in video, audio, power point or pdf files. They can also give
        online assignments, administer online quizzes, conduct forum discussions, conduct polls, etc.
        for asynchronous sessions.
        3. At the beginning of the semester, all faculty members are required to upload in the MS Teams
        the course guide with detailed syllabus for the subject. This will guide the students on the
        planned lessons for the entire semester.
        Faculty members shall also share their online teaching materials and references, discuss the
        assessment system, and define the rubrics on how assignments and other written submissions
        shall be graded.
        Consultation hours of the faculty member must also be posted in the MS Teams class so
        students will be properly guided of his/her availability.
        4. Faculty members shall conduct regular and substantive interactions with students in both
        synchronous and asynchronous modes of delivery, to determine whether the students
        understand their lessons, and to ensure that the students are participating in all course activities.
        Page 4 of 16
        5. Faculty members must ensure that the students are engaged on a minimum of 54 hours per
        semester of course credit. For this purpose, lecture activities, whether synchronous or
        asynchronous, may be supplemented with other forms of learning activities such as teamwork,
        discussion forums, homework, projects, etc.
        6. All faculty members shall attend their classes during the time designated by the college and as
        scheduled in the MS Teams, in order to avoid any scheduling conflict with the student’s other
        online classes.
        7. For monitoring purposes, Department Chairpersons or pertinent college officials shall be
        included in the MS Teams of each online class. The Department Chairperson or college official
        concerned shall submit monthly reports to the College Dean about the conduct of online classes
        in his/her department.
        B. TEAM TEACHING
        Team Teaching is defined as having more than one faculty member responsible for some
        or all of the instructional aspects of a course in any given semester.6
         Integrated team-taught model
        may be applied for online teaching where members of the team collaboratively and actively
        participate in all phases of the course, including development of course materials, evaluation
        of student work, and attendance in and preparation for all class sessions.
        The use of team-teaching for online classes shall be subject to the approval of the Office
        of the Vice President for Academic Affairs. In addition, the general guidelines for online teaching
        shall be governed by the following rules:
        1. All faculty members handling general education courses, or specialty courses with multiple
        sections, are encouraged to apply team teaching in their online classes.
        2. All of the faculty members’ names in a team-taught class will be listed in the MS Teams
        platform so that students can see that their class is team-taught. However, the first faculty
        member listed in the MS Teams shall be the lead faculty.
        3. The lead faculty shall collaborate with the other team members in the design of the course,
        identification of topics and assignments, development of course materials, and formulation of
        course policies, ensuring that each faculty member equally participates in the administration
        and conduct of the course subject.
        4. The course to be team-taught should have a course syllabus that clearly explains the nature of
        the team teaching and identifies the role of each faculty member in the team-taught class,
        including the following information:
        a. the names, contact information, and consultation hours of all the team members;
        b. criteria for assessment and evaluation;
        6 Retrieved from
        https://cla.auburn.edu/cla/assets/docs/administration/CLA%20Guidelines%20for%20Team%20Teaching.pdf
        Page 5 of 16
        c. the name(s) of the faculty member(s) who are in charge of a particular lesson; and
        d. the name of the faculty member in charge of grading
        5. Faculty members in a team-taught class may opt to deliver the learning materials, whether
        synchronous or asynchronous, simultaneously to all the combined classes, or at different times
        to each class. Faculty members may also decide that for certain class sessions, each class shall
        be handled by a different faculty member.
        6. Common assessments (i.e., exams, papers, projects) shall be determined by the lead faculty but
        may be evaluated by individual faculty members.
        C. GUIDELINES ON THE CONDUCT OF SYNCHRONOUS ONLINE CLASSES
        1. The prescribed minimum number of hours for synchronous sessions is 50% of the total required
        hours or sessions for the entire semester.
        2. For each synchronous online class, the recommended contact time is one (1) hour per session
        only, unless the faculty involved believes that more time is needed to maximize student
        engagement and learning outcomes. The remaining contact hour may be conducted thru
        asynchronous online activities. This, however, shall not exceed the allotted time of one and a
        half hours for a three-unit course.
        3. Faculty members should always notify their students thru the MS Teams, at least one (1) week
        in advance, should they decide to conduct a synchronous online class.
        4. At the beginning of the semester, faculty members shall explain to the students the required
        netiquette for online classes, as prescribed in this Omnibus Guidelines, including the proper
        use of microphones, webcams, and chat features; protocols for classroom engagement and
        student-to-student interaction during online activities; and ways to seek help using technology.
        5. Prior to the start of each synchronous session, faculty members must ensure that all equipment,
        including computers/laptops, headphones, microphones, etc. are working. Each faculty
        member should also test his/her internet connectivity and ensure good audio and video quality
        before the class starts.
        6. The use of webcam is a must for faculty members during synchronous online sessions.
        Students with weak internet connections may opt not to use their webcams.
        The use of webcam during discussions and other interactive activities can improve engagement
        and learner satisfaction. However, faculty members should also keep in mind the limits of the
        online environment for each student. For instance, if a student has a weak internet connection,
        the faculty and student can agree that the opening of webcams shall be limited to instances
        when the student is prompted to speak.
        7. Faculty members shall always maintain professional appearance throughout the synchronous
        online session. Netiquette, as prescribed under Section V (E) of this Omnibus Guidelines, shall
        be observed at all times.
        8. Faculty members should always prepare for contingency plans in the event that a technical
        problem arise, whether on the part of the students or the faculty members, during the
        synchronous online session.
        Page 6 of 16
        9. Faculty members without gadgets and/or weak internet connections will be allowed to use the
        facilities on campus, subject to approval and strict compliance with the minimum health care
        protocols being implemented by the PLM COVID-19 Task Force. The VP for Academic
        Affairs shall review and coordinate with the VP for Administration all applications for use of
        the PLM facilities for this purpose.
        D. GUIDELINES ON THE CONDUCT OF ASYNCHRONOUS ONLINE CLASSES
        1. The prescribed minimum number of hours for asynchronous sessions is 50% of the total
        required hours or sessions for the entire semester.
        2. The use of asynchronous lecture materials is highly recommended, with due regard to the
        nature, objectives and learning outcomes of the course. For this purpose, faculty members may
        consider recording several, 8 to 10-minute micro-video lectures to maximize the attention span
        and retention of students. Moreover, it may be easier to upload online materials with smaller
        bytes.
        3. In the conduct of asynchronous online classes, faculty members should provide the students
        with clear instructions and expected deliverables for every online learning material posted.
        Even in asynchronous online classes, faculty members should promote the active engagement
        of students.
        4. Faculty members should consider pacing in the completion of online learning materials, in
        order to keep all students to a similar timeline. They should also consider adequate time for
        submission of required assignments or other school works assigned to the students.
        5. Faculty members are expected to provide effective, timely and meaningful feedback to the
        asynchronous online activities of students, including recognition for good work and
        recommendations for improvement.
        E. NETIQUETTE (INTERNET ETIQUETTE) POLICIES DURING ONLINE CLASSES
        1. NETIQUETTE POLICY FOR FACULTY MEMBERS
        All faculty members of PLM, whether full-time or part-time, shall strictly comply with the
        following netiquette (internet etiquette) policies during online classes:
        a. All faculty members shall always maintain their professional appearance during
        synchronous classes by wearing proper attire. Proper attire for faculty members is at least
        collared shirt, both for synchronous and taped/asynchronous sessions.
        b. Faculty members are expected to observe professional and ethical behavior in all his/her
        dealings online. They should uphold the highest standards of decorum and behavior and
        serve as role models to their students.
        c. Faculty members should always be cognizant of, and sensitive to, their online
        communications and other online dealings with the students, other faculty members, and
        other participants in the online fora, taking into account the context of their online
        Page 7 of 16
        correspondences, their reputation and that of the University, and applicable standards of
        online behavior.
        d. In the use of online resources, faculty members should respect other people’s time and
        bandwidth, by only sending messages or posting materials that are substantive and which
        relate to the academic discussion or matter at hand. Faculty members should refrain from
        sending or posting memes, spam messages, online promotions and advertisements, and
        the like .
        e. Faculty members should only post and share content from verifiable, expert sources.
        f. Faculty members must be punctual during synchronous classes.
        g. To avoid distraction to students during synchronous online classes, faculty members
        should ensure that there are no background noise or unnecessary activities while they are
        conducting the online class. If necessary, they should select a quiet place or venue where
        they can properly engage with their students during class discussions.
        2. NETIQUETTE POLICY FOR STUDENTS
        All PLM students, whether enrolled in the undergraduate or graduate degree programs, shall
        strictly comply with the following netiquette (internet etiquette) policies during online classes,
        whether synchronous or asynchronous:
        a. Students should be punctual in attending their classes and should come prepared for class.
        They are expected to log in to their MS Teams or Zoom account at least five (5) minutes
        prior to the start of the class.
        b. All students, except new students or new transferees, shall wear the prescribed complete
        PLM uniform. New students and new transferees will be allowed to wear the appropriate
        civilian attire for the first two (2) months of the academic year, unless extended by the
        Office of the Vice President for Academic Affairs. Proper civilian attire for students is at
        least collared shirt. All students should also be properly groomed when attending online
        classes.
        c. Students should check their internet connectivity, audio, video cameras, and
        microphone/headphone prior to the start of each class to ensure good audio and video
        quality. As much as possible, they should check their surroundings and remove distractions
        or barriers that might hinder optimal learning.
        d. As a general rule, during synchronous online classes, students should keep their
        microphones on mute unless they are called and prompted to speak. However, this should
        not prevent students from actively participating in class discussions or deliberations, or
        from asking questions that are germane to the academic discussion.
        e. Students should always speak and /or chat responsibly by using proper and acceptable
        language. They should show respect to the diversity of opinions inside the virtual
        classroom and to individual differences during class discussions.
        Page 8 of 16
        f. Students should accord due respect to the professor’s and their classmates’ privacy at all
        times. Private information such as passwords, names, contact numbers, etc., should not be
        furnished to other people without the owner’s consent or permission.
        g. Recording of virtual classes by the students, whether thru direct or indirect means, is
        prohibited.
        h. Sharing of videos, lectures, and notes of professors without proper permission shall not be
        allowed.
        i. In the same way, taking screenshots of videos and images of classmates during an online
        class, and/or sharing the same without the owner’s consent or permission is prohibited.
        j. Students should leave their online classes in an appropriate manner by properly informing
        their professors beforehand that they intend to leave.
        Any violation of the abovementioned rules shall be subject to appropriate disciplinary actions
        as provided in the PLM Student Manual, the University Code, and other applicable University
        rules and regulations.
        F. STUDENT ASSESSMENT AND EVALUATION
        1. The current student grading system of PLM shall remain in place, and shall continue to be in
        force and effect, unless otherwise provided by this Omnibus Guidelines.
        2. At the beginning of the semester, faculty members shall provide rubrics, or detailed grading
        criteria, for every assignment or learning activity, to promote transparency in grading and
        evaluation.
        3. Faculty members should keep the assessment criteria relevant and appropriate to the learning
        objectives and outcomes of the course.
        4. In the assessment and evaluation of students, faculty members must provide quick and frequent
        feedbacks on the progress reports, postings, papers, and other student works in order to
        facilitate learning and maintain student motivation.
        5. In the conduct of online examinations, faculty members are encouraged to employ different
        strategies to foster academic honesty and academic excellence, such as:
        a. In multiple choice questions, faculty members may randomize the order of the correct
        answers.
        b. In online examinations, faculty members may require segment-by-segment completion of
        exams so that students will not be able to re-enter a test segment. They may also decide to
        allot a short window of time to complete the examination, as it reduces the student’s ability
        to access the test, look up the answers online, and re-enter the test.
        c. As much as possible, faculty members should resort to exams that challenges the analytical
        and critical thinking of students, such as position papers, essays and personal statements.
        d. The use of online plagiarism detection tools is encouraged.
        e. Faculty members may also add security measures to online exams, such as the use of
        passwords or lockdown browsers to prevent printing, copying, using of another URL, or
        accessing other applications.
        Page 9 of 16
        6. Faculty members should consider balancing formative and summative assessments both for
        online and modular modalities.
        7. Insights in Microsoft Teams can help faculty members catch up on all the Microsoft Teams
        activities of students, including assignment and engagements in class conversations.
        VI. USE OF PRINTED LEARNING MATERIALS FOR STUDENTS WITH NO OR
        LOW/LIMITED INTERNET CONNECTIVITY, OR NO ACCESS TO COMPUTER
        GADGETS
        1. The lack of, or low, internet connectivity, or the lack of access to computer gadgets, shall
        not be a hindrance to receiving quality education in PLM, nor should it pose any burden
        or difficulty to the students.
        2. The use of printed learning materials shall be the preferred mode of learning delivery to
        students with no internet connectivity.
        3. For students with low or limited internet connectivity, they may also resort to the use of
        these learning materials, which may be sent to them via email, Facebook messenger, or other
        online means, whether in pdf or other acceptable format.
        4. All colleges should regularly conduct a survey of all students to determine access to internet
        connectivity and computer gadgets for both students and faculty members, and recommend
        solutions as necessary. Based on this survey, each college should determine the volume and
        extent of printed materials to be produced and distributed to affected students.
        5. The printed learning materials may be picked up by the student’s representatives at selected
        pick-up points in PLM, or may be delivered to the students’ residence themselves, thru the
        Manila Barangay Bureau. For the specific guidelines and procedure on the printing and
        distribution of printed learning materials, please refer to attached Annex A.
        6. The printed learning materials shall contain the following minimum components:
         Introduction/overview of the course, including the timeline of learning activities that
        the student is expected to finish.
         Learning goals and objectives of each particular module
         Lesson proper
         Exercises and other learning activities that the student is expected to accomplish, such
        as readings and other supplemental activities. Each learning activity should have a
        clear instruction for its accomplishment.
         Assignments
         Assessment/evaluation for the particular module
        7. In the preparation of printed learning materials, faculty members must ensure that there are
        sufficient readings and activities in each module, equivalent to prescribed activities for online
        classes.
        Page 10 of 16
        8. For students using printed learning materials, up to 90% of contact hours may be allowed for
        the student’s self-study, accomplishment of written works and other activities prescribed in the
        printed modules. However, these students are required to attend, at a minimum, synchronous
        meetings with their faculty member on the first and last day of classes. During the last day of
        class, these students are required to deliver their final outputs for the course, which may
        include, but not limited to, oral examination, revalida or submission of final output/written
        paper.
        9. Faculty members shall regularly communicate with students who availed of the printed learning
        materials instead of online classes. For this purpose, calls, text messaging, chat or similar
        modes of communications, may be used. The faculty member and student concerned shall
        retain records of their communication for monitoring purposes.
        VII. USE OF COPYRIGHTED MATERIALS AS INSTRUCTIONAL MATERIALS
        1. In the preparation of learning materials, whether online or printed, copyrighted materials may
        be used by faculty members provided that he/she has written permission from the copyright
        owner, and references or citations are properly included. In certain circumstances however, the
        use of copyrighted materials without written permission may be allowed provided that the same
        is compatible with “fair use” as provided under Republic Act No. 8293 (Intellectual Property
        Code).
        2. Only the following instructional materials may be allowed to be posted in the LMS:
        a. Instructional materials the copyright of which is owned by the faculty member concerned.
        b. Instructional materials the copyright owner of which has granted written permission for its
        use in PLM.
        c. The instructional material is made available thru linking rather than direct uploading or
        copying.
        d. Instructional materials that belong in the public domain.
        e. Instructional materials the use of which is compatible with fair use under R.A. No. 8293.
        VIII. ATTENDANCE POLICY FOR STUDENTS DURING FLEXIBLE LEARNING
        1. During this period when classroom teaching is not allowed, class attendance cannot be imposed as
        a requirement as part of the students’ grade evaluation. Instead, individual outputs that demonstrate
        the students’ learning outcomes must be used. Further, the faculty member shall:
        a. Not impose a higher standard for student participation in a remote learning environment
        compared to a seat-time requirement of being physically present.
        b. Shall communicate a clear and consistent message on what student engagement means for
        each learning activity.
        c. Provide early intervention to students who need academic, intellectual, emotional and
        logistical support to avoid academic disengagement and chronic absences.
        2. Student attendance in an online session is defined as active participation in the class session at least
        once during the meeting. A student logging-in to an online class is not sufficient to establish
        Page 11 of 16
        academic attendance. Instead, the student must engage in the academic discussion, as evidenced
        by, but not limited to, any of the following:
         Joining in and actively participating on, either by actively listening or thru recitations, a
        synchronous online class session where there is an opportunity for direct interaction between
        the faculty member and the students;
         Submission of an academic assignment/ homework/project on time;
         Submission of an exam/ quiz on time;
         Posting by the student, within the prescribed period, in a discussion forum which shows the
        student’s participation in the online academic discussion;
         An email from the student or other documentation which shows the student-initiated contact
        with a faculty member, within the prescribed time period; and
         Student participation during scheduled academic related activities and services
        3. For students who use printed learning materials, student attendance may be considered in any of
        the following cases:
         Submission of an academic assignment/homework/project on time;
         Submission of an exam/ quiz or equivalent outputs on time; and
         Checking-in with the faculty member at least twice a week via online chats or call/text
        messaging through cellular phone, or other means of communication, provided that the same
        is fully documented by the student and the faculty member concerned.
        4. Minimum attendance required for students for synchronous sessions is at least 10% of the total
        synchronous sessions and for asynchronous sessions is also at least 10% of the total asynchronous
        sessions, for them not to be dropped in the subject
        All other Orders, Memoranda, and other issuances inconsistent with this Order are deemed amended,
        modified, revoked, or suspended accordingly.";

        // Tokenize the texts
        $tokenizer = new WhitespaceTokenizer();
        $complaintTokens = $tokenizer->tokenize($complaint);
        $policyTokens = $tokenizer->tokenize($policyText);
            // dd($policyTokens);
        // Calculate cosine similarity
        $cosineSimilarity = new CosineSimilarity();
        $similarity = $cosineSimilarity->similarity($complaintTokens, $policyTokens);

        // Set a threshold for similarity (you can adjust this as needed)
        $threshold = 0;

        // Check if the similarity meets the threshold
        if ($similarity >= $threshold) {
            return "The complaint aligns with the policy.";
        } else {
            return "The complaint does not align with the policy.";
        }
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

}
