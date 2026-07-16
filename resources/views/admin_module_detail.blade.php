@extends('dashboard_app')

@push('title')
    {{ $module->title }}
@endpush
@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

        <a href="{{ route('admin.courses.modules', $module->course) }}" style="font-size:13px; color:#6b7280; text-decoration:none;">
            <i class="fa fa-arrow-left"></i> Back to {{ $module->course->name }}
        </a>

        <h1 style="font-size:22px; font-weight:600; color:#111827; margin:12px 0 4px;">
            <span style="font-size:13px; background:#eef2ff; color:#4f46e5; padding:2px 8px; border-radius:5px; margin-right:8px;">{{ $module->module_code }}</span>
            {{ $module->title }}
        </h1>
        <p style="font-size:13px; color:#6b7280; margin-bottom:20px;">{{ $module->description }}</p>

        @if (session('message'))
            <div style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                {{ session('message') }}
            </div>
        @endif

        <!-- Tabs -->
        <div style="display:flex; gap:8px; margin-bottom:20px; border-bottom:1px solid #e5e7eb;">
            <button onclick="showTab('topics')" id="tab-topics" class="module-tab active-tab" style="padding:10px 16px; border:none; background:none; font-size:14px; cursor:pointer; border-bottom:2px solid #5D5FEF; color:#5D5FEF; font-weight:600;">Topics / Lecture Notes</button>
            <button onclick="showTab('assignments')" id="tab-assignments" class="module-tab" style="padding:10px 16px; border:none; background:none; font-size:14px; cursor:pointer; border-bottom:2px solid transparent; color:#6b7280;">Assignments</button>
            <button onclick="showTab('exams')" id="tab-exams" class="module-tab" style="padding:10px 16px; border:none; background:none; font-size:14px; cursor:pointer; border-bottom:2px solid transparent; color:#6b7280;">Exams (MCQ)</button>
        </div>

        <!-- TOPICS TAB -->
        <div id="content-topics" class="module-tab-content">
            <button onclick="openAddTopicModal()" style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:13px;font-weight:700;cursor:pointer; margin-bottom:16px;">
                + Add Topic
            </button>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                @forelse ($module->topics as $topic)
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; padding:14px 0; border-bottom:1px solid #f3f4f6;">
                        <div>
                            <h4 style="font-size:15px; font-weight:600; color:#111827; margin-bottom:4px;">{{ $topic->order }}. {{ $topic->title }}</h4>
                            <p style="font-size:13px; color:#6b7280; margin-bottom:6px;">{{ $topic->description }}</p>
                            @if ($topic->file_path)
                                <a href="{{ asset('storage/' . $topic->file_path) }}" target="_blank" style="font-size:12px; color:#2563eb; text-decoration:none;">
                                    <i class="fa fa-file-text-o"></i> {{ $topic->original_name }}
                                </a>
                            @endif
                        </div>
                        <div>
                            <form id="delete-topic-form-{{ $topic->id }}" action="{{ route('admin.topics.destroy', $topic) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="icon-btn icon-btn-delete" title="Delete" onclick="confirmDeleteGeneric('delete-topic-form-{{ $topic->id }}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="color:#8A8AA3; text-align:center; padding:16px;">No topics yet.</p>
                @endforelse
            </div>
        </div>

        <!-- ASSIGNMENTS TAB -->
        <div id="content-assignments" class="module-tab-content" style="display:none;">
            <button onclick="openAddAssignmentModal()" style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:13px;font-weight:700;cursor:pointer; margin-bottom:16px;">
                + Add Assignment
            </button>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                @forelse ($module->assignments as $assignment)
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; padding:14px 0; border-bottom:1px solid #f3f4f6;">
                        <div>
                            <h4 style="font-size:15px; font-weight:600; color:#111827; margin-bottom:4px;">{{ $assignment->title }}</h4>
                            <p style="font-size:13px; color:#6b7280; margin-bottom:6px;">{{ $assignment->description }}</p>
                            @if ($assignment->start_date || $assignment->end_date)
                                <div style="font-size:12px; color:#6b7280; margin-top:4px;">
                                    @if ($assignment->start_date)
                                        <span><i class="fa fa-play-circle-o"></i> Starts: {{ \Carbon\Carbon::parse($assignment->start_date)->format('M d, Y g:i A') }}</span>
                                    @endif
                                    @if ($assignment->end_date)
                                        <br><span style="color:#dc2626;"><i class="fa fa-flag-checkered"></i> Ends: {{ \Carbon\Carbon::parse($assignment->end_date)->format('M d, Y g:i A') }}</span>
                                    @endif
                                </div>
                            @endif
                            @if ($assignment->file_path)
                                <br><a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" style="font-size:12px; color:#2563eb; text-decoration:none;">
                                    <i class="fa fa-paperclip"></i> {{ $assignment->original_name }}
                                </a>
                            @endif
                        </div>
                        <div>
                            <form id="delete-assignment-form-{{ $assignment->id }}" action="{{ route('admin.assignments.destroy', $assignment) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="icon-btn icon-btn-delete" title="Delete" onclick="confirmDeleteGeneric('delete-assignment-form-{{ $assignment->id }}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="color:#8A8AA3; text-align:center; padding:16px;">No assignments yet.</p>
                @endforelse
            </div>
        </div>

        <!-- EXAMS TAB -->
        <div id="content-exams" class="module-tab-content" style="display:none;">
            <button onclick="openAddExamModal()" style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:13px;font-weight:700;cursor:pointer; margin-bottom:16px;">
                + Add Exam
            </button>

            @forelse ($module->exams as $exam)
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; margin-bottom:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <div>
                            <h4 style="font-size:15px; font-weight:600; color:#111827;">
                                {{ $exam->title }}
                                @if ($exam->status === 'published')
                                    <span style="font-size:11px; background:#dcfce7; color:#16a34a; padding:2px 8px; border-radius:5px; margin-left:6px;">Published</span>
                                @else
                                    <span style="font-size:11px; background:#fef3c7; color:#b45309; padding:2px 8px; border-radius:5px; margin-left:6px;">Draft</span>
                                @endif
                            </h4>
                            <span style="font-size:12px; color:#6b7280;">{{ $exam->questions->count() }} questions @if($exam->duration_minutes) &middot; {{ $exam->duration_minutes }} mins @endif</span>
                        </div>
                        <div>
                            @if ($exam->status === 'draft')
                                <button onclick="openAddQuestionModal({{ $exam->id }})" style="background:#eef2ff; color:#4f46e5; border:none; border-radius:6px; padding:6px 12px; font-size:12px; cursor:pointer; margin-right:6px;">
                                    + Add Question
                                </button>
                                <form id="publish-exam-form-{{ $exam->id }}" action="{{ route('admin.exams.publish', $exam) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="button" onclick="confirmPublishExam('publish-exam-form-{{ $exam->id }}')" style="background:#16a34a; color:#fff; border:none; border-radius:6px; padding:6px 12px; font-size:12px; cursor:pointer; margin-right:6px;">
                                        <i class="fa fa-check"></i> Publish
                                    </button>
                                </form>
                            @endif
                            <form id="delete-exam-form-{{ $exam->id }}" action="{{ route('admin.exams.destroy', $exam) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="icon-btn icon-btn-delete" title="Delete" onclick="confirmDeleteGeneric('delete-exam-form-{{ $exam->id }}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    @foreach ($exam->questions as $i => $question)
                        <div style="padding:12px 0; border-top:1px solid #f3f4f6;">
                            <p style="font-size:14px; font-weight:600; color:#111827; margin-bottom:8px;">{{ $i + 1 }}. {{ $question->question }}</p>
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:6px; font-size:13px;">
                                <div style="color:{{ $question->correct_option === 'a' ? '#16a34a' : '#6b7280' }};">A. {{ $question->option_a }} {{ $question->correct_option === 'a' ? '✓' : '' }}</div>
                                <div style="color:{{ $question->correct_option === 'b' ? '#16a34a' : '#6b7280' }};">B. {{ $question->option_b }} {{ $question->correct_option === 'b' ? '✓' : '' }}</div>
                                <div style="color:{{ $question->correct_option === 'c' ? '#16a34a' : '#6b7280' }};">C. {{ $question->option_c }} {{ $question->correct_option === 'c' ? '✓' : '' }}</div>
                                <div style="color:{{ $question->correct_option === 'd' ? '#16a34a' : '#6b7280' }};">D. {{ $question->option_d }} {{ $question->correct_option === 'd' ? '✓' : '' }}</div>
                            </div>
                            <form id="delete-question-form-{{ $question->id }}" action="{{ route('admin.questions.destroy', $question) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDeleteGeneric('delete-question-form-{{ $question->id }}')" style="background:none; border:none; color:#dc2626; font-size:11px; cursor:pointer; margin-top:6px;">
                                    <i class="fa fa-trash"></i> Remove question
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @empty
                <p style="color:#8A8AA3; text-align:center; padding:16px;">No exams yet.</p>
            @endforelse
        </div>

    </div>

    <!-- Add Topic Modal -->
    <div id="addTopicModal" style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 20px 0;color:#1B1B33;">Add topic</h3>
            <form method="POST" action="{{ route('admin.topics.store', $module) }}" enctype="multipart/form-data">
                @csrf
                <input name="title" placeholder="Topic title" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <textarea name="description" placeholder="Description" rows="3"
                          style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;"></textarea>
                <label style="font-size:12px; color:#6b7280;">Lecture Notes (optional)</label>
                <input name="file" type="file"
                       style="width:100%;padding:11px;margin-top:6px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeModal('addTopicModal')"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">Cancel</button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">Add topic</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Assignment Modal -->
    <div id="addAssignmentModal" style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:420px;max-height:90vh;overflow-y:auto;">
            <h3 style="margin:0 0 20px 0;color:#1B1B33;">Add assignment</h3>
            <form method="POST" action="{{ route('admin.assignments.store', $module) }}" enctype="multipart/form-data">
                @csrf

                <label style="font-size:12px; color:#6b7280;">Assignment Title</label>
                <input name="title" placeholder="Assignment title" required
                       style="width:100%;padding:11px;margin-top:6px;margin-bottom:12px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <label style="font-size:12px; color:#6b7280;">Description / Instructions</label>
                <textarea name="description" placeholder="Description" rows="3"
                          style="width:100%;padding:11px;margin-top:6px;margin-bottom:12px;border:1.5px solid #E4E4EF;border-radius:8px;"></textarea>

                <label style="font-size:12px; color:#6b7280;">Start Date &amp; Time</label>
                <input name="start_date" type="datetime-local"
                       style="width:100%;padding:11px;margin-top:6px;margin-bottom:12px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <label style="font-size:12px; color:#6b7280;">Due Date &amp; Time</label>
                <input name="end_date" type="datetime-local"
                       style="width:100%;padding:11px;margin-top:6px;margin-bottom:12px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <label style="font-size:12px; color:#6b7280;">Assignment File (optional)</label>
                <input name="file" type="file"
                       style="width:100%;padding:11px;margin-top:6px;margin-bottom:20px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeModal('addAssignmentModal')"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">Cancel</button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">Add assignment</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Exam Modal -->
    <div id="addExamModal" style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 20px 0;color:#1B1B33;">Add exam</h3>
            <form method="POST" action="{{ route('admin.exams.store', $module) }}">
                @csrf
                <input name="title" placeholder="Exam title" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="duration_minutes" type="number" placeholder="Duration (minutes, optional)"
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <label style="font-size:12px; color:#6b7280;">Start Date &amp; Time</label>
                <input name="start_date" type="datetime-local"
                       style="width:100%;padding:11px;margin-top:6px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <label style="font-size:12px; color:#6b7280;">End Date &amp; Time</label>
                <input name="end_date" type="datetime-local"
                       style="width:100%;padding:11px;margin-top:6px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeModal('addExamModal')"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">Cancel</button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">Create exam</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Question Modal -->
    <div id="addQuestionModal" style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:450px;">
            <h3 style="margin:0 0 20px 0;color:#1B1B33;">Add question</h3>
            <form id="add-question-form" method="POST">
                @csrf
                <textarea name="question" placeholder="Question text" required rows="2"
                          style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;"></textarea>
                <input name="option_a" placeholder="Option A" required
                       style="width:100%;padding:11px;margin-bottom:8px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="option_b" placeholder="Option B" required
                       style="width:100%;padding:11px;margin-bottom:8px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="option_c" placeholder="Option C" required
                       style="width:100%;padding:11px;margin-bottom:8px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="option_d" placeholder="Option D" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <select name="correct_option" required style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <option value="">-- Correct option --</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeModal('addQuestionModal')"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">Cancel</button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">Add question</button>
                </div>
            </form>
        </div>
    </div>

@endsection
