<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Резюме - {{ $resume->full_name }}</title>
    <style>
        @page {
            margin: 0cm;
        }
        body {
            margin: 2cm;
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
        }
        h1, h2 {
            color: #1a4dab;
        }
        h1 {
            font-size: 22px;
            margin: 0;
        }
        h2 {
            font-size: 16px;
            margin: 15px 0 5px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
        }
        .section {
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .skills span {
            display: inline-block;
            background: #f0f0f0;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 12px;
            font-size: 12px;
        }
        .photo {
            float: right;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-left: 10px;
            border: 1px solid #ccc;
        }
        .text-muted {
            color: #777;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="section" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; overflow: hidden;">
    @if ($resume->photo_path)
        <img class="photo" src="{{ public_path('storage/' . $resume->photo_path) }}" alt="Фото">
    @endif
    <h1>{{ $resume->full_name }}</h1>
    @if ($resume->position)
        <p class="text-muted" style="margin-top: 5px;">{{ $resume->position }}</p>
    @endif
</div>

<!-- Contact Info -->
<div class="section">
    <div class="info">
        <span class="label">Телефон:</span> {{ $resume->phone }}<br>
        <span class="label">Email:</span> {{ $resume->email }}
    </div>

    @if ($resume->about)
        <h2>О себе</h2>
        <p>{{ $resume->about }}</p>
    @endif
</div>

<!-- Education -->
@if ($resume->educations->count())
    <div class="section">
        <h2>Образование</h2>
        @foreach ($resume->educations as $education)
            <div class="card">
                <div><strong>{{ $education->institution }}</strong></div>
                <div class="text-muted">{{ $education->degree }}, {{ $education->field_of_study }}</div>
                <div style="font-size: 12px; margin-top: 2px;">{{ $education->start_date }} - {{ $education->end_date ?: 'По настоящее время' }}</div>
                @if ($education->description)
                    <div style="margin-top: 5px;">{{ $education->description }}</div>
                @endif
            </div>
        @endforeach
    </div>
@endif

<!-- Experience -->
@if ($resume->experiences->count())
    <div class="section">
        <h2>Опыт работы</h2>
        @foreach ($resume->experiences as $experience)
            <div class="card">
                <div><strong>{{ $experience->position }}</strong></div>
                <div class="text-muted">{{ $experience->company }}</div>
                <div style="font-size: 12px; margin-top: 2px;">{{ $experience->start_date }} - {{ $experience->end_date ?: 'По настоящее время' }}</div>
                @if ($experience->description)
                    <div style="margin-top: 5px;">{{ $experience->description }}</div>
                @endif
            </div>
        @endforeach
    </div>
@endif

<!-- Skills -->
@if ($resume->skills->count())
    <div class="section">
        <h2>Навыки</h2>
        <div class="skills">
            @foreach ($resume->skills as $skill)
                <span>{{ $skill->name }}{{ $skill->level ? " ({$skill->level})" : '' }}</span>
            @endforeach
        </div>
    </div>
@endif

</body>
</html>
