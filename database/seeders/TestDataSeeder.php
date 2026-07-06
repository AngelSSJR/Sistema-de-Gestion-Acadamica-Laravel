<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Profesores
        $teachersData = [
            ['name' => 'Carlos Mendoza', 'email' => 'carlos@test.com', 'employee_code' => 'TCH001', 'specialty' => 'Matemáticas'],
            ['name' => 'María López', 'email' => 'maria@test.com', 'employee_code' => 'TCH002', 'specialty' => 'Lenguaje'],
            ['name' => 'José García', 'email' => 'jose@test.com', 'employee_code' => 'TCH003', 'specialty' => 'Ciencias'],
        ];

        foreach ($teachersData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password'),
                    'phone' => '555-' . str_pad(random_int(100, 999), 3, '0', STR_PAD_LEFT),
                    'email_verified_at' => now(),
                ]
            );
            if (!$user->hasRole('teacher')) {
                $user->assignRole('teacher');
            }
            Teacher::firstOrCreate(
                ['employee_code' => $data['employee_code']],
                [
                    'user_id' => $user->id,
                    'specialty' => $data['specialty'],
                    'hire_date' => now()->subYears(random_int(1, 10)),
                    'education_level' => collect(['Licenciatura', 'Maestría', 'Doctorado'])->random(),
                ]
            );
        }

        // Estudiantes
        $studentsData = [
            ['name' => 'Ana Torres', 'email' => 'ana@test.com', 'student_code' => 'STU001', 'age' => 16],
            ['name' => 'Luis Martínez', 'email' => 'luis@test.com', 'student_code' => 'STU002', 'age' => 15],
            ['name' => 'Sofía Ramírez', 'email' => 'sofia@test.com', 'student_code' => 'STU003', 'age' => 16],
            ['name' => 'Diego Hernández', 'email' => 'diego@test.com', 'student_code' => 'STU004', 'age' => 17],
            ['name' => 'Valentina Gómez', 'email' => 'valentina@test.com', 'student_code' => 'STU005', 'age' => 22],
        ];

        foreach ($studentsData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password'),
                    'phone' => '555-' . str_pad(random_int(100, 999), 3, '0', STR_PAD_LEFT),
                    'email_verified_at' => now(),
                ]
            );
            if (!$user->hasRole('student')) {
                $user->assignRole('student');
            }
            Student::firstOrCreate(
                ['student_code' => $data['student_code']],
                [
                    'user_id' => $user->id,
                    'age' => $data['age'] ?? null,
                    'enrollment_date' => now()->subMonths(random_int(1, 24)),
                    'status' => 'active',
                ]
            );
        }

        // Cursos
        $coursesData = [
            ['name' => '10° Grado A', 'code' => '10A', 'level' => 'Secundaria', 'section' => 'A', 'academic_year' => '2026-2027'],
            ['name' => '10° Grado B', 'code' => '10B', 'level' => 'Secundaria', 'section' => 'B', 'academic_year' => '2026-2027'],
            ['name' => '11° Grado A', 'code' => '11A', 'level' => 'Secundaria', 'section' => 'A', 'academic_year' => '2026-2027'],
            ['name' => '3° Semestre', 'code' => '3SEM', 'level' => 'Universitario', 'section' => 'Única', 'academic_year' => '2026-2027'],
        ];

        foreach ($coursesData as $data) {
            Course::firstOrCreate(['code' => $data['code']], $data);
        }

        // Materias
        $subjectsData = [
            ['name' => 'Matemáticas I', 'code' => 'MAT101', 'credits' => 5],
            ['name' => 'Lenguaje y Literatura', 'code' => 'LEN101', 'credits' => 4],
            ['name' => 'Ciencias Naturales', 'code' => 'CIE101', 'credits' => 4],
            ['name' => 'Historia Universal', 'code' => 'HIS101', 'credits' => 3],
            ['name' => 'Inglés Básico', 'code' => 'ING101', 'credits' => 3],
            ['name' => 'Educación Física', 'code' => 'EDF101', 'credits' => 2],
        ];

        foreach ($subjectsData as $data) {
            Subject::firstOrCreate(['code' => $data['code']], $data);
        }

        // Ambientes
        $roomsData = [
            ['name' => 'Aula 101', 'code' => 'A101', 'capacity' => 30, 'resources' => 'Pizarra, proyector, aire acondicionado'],
            ['name' => 'Aula 102', 'code' => 'A102', 'capacity' => 25, 'resources' => 'Pizarra, ventilador'],
            ['name' => 'Aula 201', 'code' => 'B201', 'capacity' => 35, 'resources' => 'Pizarra, proyector, aire acondicionado, computadora'],
            ['name' => 'Aula 202', 'code' => 'B202', 'capacity' => 30, 'resources' => 'Pizarra, proyector'],
            ['name' => 'Aula 301', 'code' => 'C301', 'capacity' => 20, 'resources' => 'Pizarra, aire acondicionado'],
            ['name' => 'Aula 302', 'code' => 'C302', 'capacity' => 25, 'resources' => 'Pizarra, ventilador'],
            ['name' => 'Aula 401', 'code' => 'D401', 'capacity' => 40, 'resources' => 'Pizarra, proyector, aire acondicionado, equipo de sonido'],
            ['name' => 'Aula 402', 'code' => 'D402', 'capacity' => 35, 'resources' => 'Pizarra, proyector, aire acondicionado'],
            ['name' => 'Laboratorio de Química', 'code' => 'LAB-QM', 'capacity' => 20, 'resources' => 'Mesas de laboratorio, microscopios, reactivos, pizarra'],
            ['name' => 'Laboratorio de Informática', 'code' => 'LAB-INF', 'capacity' => 25, 'resources' => '25 computadoras, proyector, pizarra, aire acondicionado'],
        ];

        foreach ($roomsData as $data) {
            Room::firstOrCreate(['code' => $data['code']], $data);
        }

        // Asignar materias a cursos (course_subject)
        $course = Course::where('code', '10A')->first();
        $course->subjects()->syncWithoutDetaching(
            Subject::whereIn('code', ['MAT101', 'LEN101', 'CIE101', 'ING101', 'EDF101'])->pluck('id')
        );

        $course = Course::where('code', '10B')->first();
        $course->subjects()->syncWithoutDetaching(
            Subject::whereIn('code', ['MAT101', 'LEN101', 'CIE101', 'HIS101'])->pluck('id')
        );

        $course = Course::where('code', '11A')->first();
        $course->subjects()->syncWithoutDetaching(
            Subject::whereIn('code', ['MAT101', 'LEN101', 'HIS101', 'ING101'])->pluck('id')
        );

        $course = Course::where('code', '3SEM')->first();
        $course->subjects()->syncWithoutDetaching(
            Subject::whereIn('code', ['MAT101', 'LEN101', 'ING101'])->pluck('id')
        );

        // Asignar materias a profesores (teacher_subject)
        $teacher = Teacher::where('employee_code', 'TCH001')->first();
        $teacher->subjects()->syncWithoutDetaching(
            Subject::whereIn('code', ['MAT101'])->pluck('id')
        );

        $teacher = Teacher::where('employee_code', 'TCH002')->first();
        $teacher->subjects()->syncWithoutDetaching(
            Subject::whereIn('code', ['LEN101', 'HIS101'])->pluck('id')
        );

        $teacher = Teacher::where('employee_code', 'TCH003')->first();
        $teacher->subjects()->syncWithoutDetaching(
            Subject::whereIn('code', ['CIE101', 'EDF101'])->pluck('id')
        );

        // Matrículas
        $academicPeriod = '2026-2027';
        $students = Student::where('status', 'active')->get();
        $courses = Course::all();

        $enrollmentMap = [
            'STU001' => '10A',
            'STU002' => '10A',
            'STU003' => '10B',
            'STU004' => '11A',
            'STU005' => '3SEM',
        ];

        foreach ($enrollmentMap as $code => $courseCode) {
            $student = $students->firstWhere('student_code', $code);
            $course = $courses->firstWhere('code', $courseCode);
            if ($student && $course) {
                Enrollment::firstOrCreate(
                    ['student_id' => $student->id, 'course_id' => $course->id, 'academic_period' => $academicPeriod],
                    ['enrollment_date' => now()->subMonths(2), 'status' => 'active']
                );
            }
        }

        // Horarios
        $teachers = Teacher::with('user')->get();
        $subjects = Subject::all();
        $rooms = Room::all();

        $scheduleData = [
            // 10A - Matemáticas: Lunes y Miércoles (multi-day demo)
            ['course_code' => '10A', 'subject_code' => 'MAT101', 'teacher_code' => 'TCH001', 'days' => ['monday', 'wednesday'], 'start' => '07:00', 'end' => '08:00', 'room' => 'A101'],
            // 10A - Lenguaje: Lunes y Viernes
            ['course_code' => '10A', 'subject_code' => 'LEN101', 'teacher_code' => 'TCH002', 'days' => ['monday', 'friday'], 'start' => '08:00', 'end' => '09:00', 'room' => 'A102'],
            // 10A - Ciencias: Martes
            ['course_code' => '10A', 'subject_code' => 'CIE101', 'teacher_code' => 'TCH003', 'days' => ['tuesday'], 'start' => '07:00', 'end' => '08:00', 'room' => 'B201'],
            ['course_code' => '10A', 'subject_code' => 'ING101', 'teacher_code' => 'TCH001', 'days' => ['tuesday'], 'start' => '08:00', 'end' => '09:00', 'room' => 'B202'],
            // 10B - Lunes
            ['course_code' => '10B', 'subject_code' => 'MAT101', 'teacher_code' => 'TCH001', 'days' => ['monday'], 'start' => '09:00', 'end' => '10:00', 'room' => 'A101'],
            ['course_code' => '10B', 'subject_code' => 'LEN101', 'teacher_code' => 'TCH002', 'days' => ['monday'], 'start' => '10:00', 'end' => '11:00', 'room' => 'A102'],
            // 11A - Miércoles
            ['course_code' => '11A', 'subject_code' => 'MAT101', 'teacher_code' => 'TCH001', 'days' => ['wednesday'], 'start' => '07:00', 'end' => '08:00', 'room' => 'C301'],
            ['course_code' => '11A', 'subject_code' => 'HIS101', 'teacher_code' => 'TCH002', 'days' => ['wednesday'], 'start' => '08:00', 'end' => '09:00', 'room' => 'C302'],
            // 3SEM - Jueves
            ['course_code' => '3SEM', 'subject_code' => 'MAT101', 'teacher_code' => 'TCH001', 'days' => ['thursday'], 'start' => '18:00', 'end' => '20:00', 'room' => 'D401'],
            ['course_code' => '3SEM', 'subject_code' => 'ING101', 'teacher_code' => 'TCH002', 'days' => ['thursday'], 'start' => '20:00', 'end' => '22:00', 'room' => 'D402'],
        ];

        foreach ($scheduleData as $data) {
            $course = $courses->firstWhere('code', $data['course_code']);
            $subject = $subjects->firstWhere('code', $data['subject_code']);
            $teacher = $teachers->firstWhere('employee_code', $data['teacher_code']);
            $room = $rooms->firstWhere('code', $data['room']);

            if ($course && $subject && $teacher) {
                Schedule::firstOrCreate(
                    [
                        'course_id' => $course->id,
                        'subject_id' => $subject->id,
                        'start_time' => $data['start'],
                        'teacher_id' => $teacher->id,
                    ],
                    [
                        'day_of_week' => $data['days'],
                        'end_time' => $data['end'],
                        'room_id' => $room?->id,
                        'room' => $data['room'],
                        'academic_period' => $academicPeriod,
                    ]
                );
            }
        }

        // Calificaciones
        $teachers = Teacher::with('user')->get();
        $tch001 = $teachers->firstWhere('employee_code', 'TCH001');
        $tch002 = $teachers->firstWhere('employee_code', 'TCH002');
        $tch003 = $teachers->firstWhere('employee_code', 'TCH003');
        $subjects = Subject::all();
        $mat = $subjects->firstWhere('code', 'MAT101');
        $len = $subjects->firstWhere('code', 'LEN101');
        $cie = $subjects->firstWhere('code', 'CIE101');
        $ing = $subjects->firstWhere('code', 'ING101');

        $gradesData = [
            // Ana Torres (STU001) en 10A -> MAT101, LEN101, CIE101, ING101, EDF101
            ['student_code' => 'STU001', 'subject_code' => 'MAT101', 'teacher_code' => 'TCH001', 'period' => 1, 'grade_value' => 15.5, 'comment' => 'Buen desempeño'],
            ['student_code' => 'STU001', 'subject_code' => 'LEN101', 'teacher_code' => 'TCH002', 'period' => 1, 'grade_value' => 17.0],
            ['student_code' => 'STU001', 'subject_code' => 'CIE101', 'teacher_code' => 'TCH003', 'period' => 1, 'grade_value' => 14.0],
            ['student_code' => 'STU001', 'subject_code' => 'ING101', 'teacher_code' => 'TCH001', 'period' => 1, 'grade_value' => 18.5],
            ['student_code' => 'STU001', 'subject_code' => 'MAT101', 'teacher_code' => 'TCH001', 'period' => 2, 'grade_value' => 16.0],
            // Luis Martínez (STU002) en 10A
            ['student_code' => 'STU002', 'subject_code' => 'MAT101', 'teacher_code' => 'TCH001', 'period' => 1, 'grade_value' => 12.0],
            ['student_code' => 'STU002', 'subject_code' => 'LEN101', 'teacher_code' => 'TCH002', 'period' => 1, 'grade_value' => 10.5],
            ['student_code' => 'STU002', 'subject_code' => 'CIE101', 'teacher_code' => 'TCH003', 'period' => 1, 'grade_value' => 8.0, 'comment' => 'Necesita mejorar'],
        ];

        foreach ($gradesData as $data) {
            $student = $students->firstWhere('student_code', $data['student_code']);
            $course = Course::where('code', $enrollmentMap[$data['student_code']])->first();
            $enrollment = Enrollment::where('student_id', $student->id)->where('course_id', $course->id)->first();
            $subject = $subjects->firstWhere('code', $data['subject_code']);
            $teacher = $teachers->firstWhere('employee_code', $data['teacher_code']);

            if ($enrollment && $subject && $teacher) {
                Grade::firstOrCreate(
                    ['enrollment_id' => $enrollment->id, 'subject_id' => $subject->id, 'period' => $data['period']],
                    [
                        'teacher_id' => $teacher->id,
                        'grade_value' => $data['grade_value'],
                        'comment' => $data['comment'] ?? null,
                        'academic_period' => $academicPeriod,
                    ]
                );
            }
        }

        // Asistencia
        $schedules = Schedule::all();
        $adminUser = User::where('email', 'admin@sistema.test')->first();

        $attendanceData = [
            ['schedule_id' => $schedules->first()?->id, 'student_code' => 'STU001', 'date' => now()->subDays(3)->format('Y-m-d'), 'status' => 'present'],
            ['schedule_id' => $schedules->first()?->id, 'student_code' => 'STU002', 'date' => now()->subDays(3)->format('Y-m-d'), 'status' => 'present'],
            ['schedule_id' => $schedules->first()?->id, 'student_code' => 'STU001', 'date' => now()->subDays(2)->format('Y-m-d'), 'status' => 'late'],
            ['schedule_id' => $schedules->first()?->id, 'student_code' => 'STU002', 'date' => now()->subDays(2)->format('Y-m-d'), 'status' => 'absent'],
        ];

        foreach ($attendanceData as $data) {
            $student = $students->firstWhere('student_code', $data['student_code']);
            if ($student && $data['schedule_id'] && $adminUser) {
                Attendance::firstOrCreate(
                    ['student_id' => $student->id, 'schedule_id' => $data['schedule_id'], 'date' => $data['date']],
                    [
                        'status' => $data['status'],
                        'registered_by' => $adminUser->id,
                    ]
                );
            }
        }

        $this->command->info('Datos de prueba creados: 3 profesores, 5 estudiantes, 4 cursos, 6 materias, 5 matrículas, 10 horarios, 8 calificaciones, 4 asistencias.');
    }
}
