<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $user->name }} - CV</title>
    <style>
        @font-face {
            font-family: 'Open Sans';
            src: url('{{ storage_path('fonts/OpenSans-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Open Sans';
            src: url('{{ storage_path('fonts/OpenSans-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
        h1 {
            font-size: 24pt;
            margin: 0 0 5px 0;
            color: #2a3f5f;
        }
        .contact-info {
            font-size: 10pt;
            margin-bottom: 5px;
        }
        .social-links {
            font-size: 10pt;
        }
        .social-links a {
            color: #2a3f5f;
            text-decoration: none;
        }
        .section {
            margin-bottom: 20px;
        }
        h2 {
            font-size: 14pt;
            color: #2a3f5f;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .experience, .project {
            margin-bottom: 15px;
        }
        .experience-header, .project-header {
            display: flex;
            justify-content: space-between;
        }
        .position {
            font-weight: bold;
            font-size: 12pt;
            color: #333;
        }
        .company {
            font-weight: normal;
        }
        .dates {
            font-style: italic;
            color: #666;
            font-size: 10pt;
        }
        .description {
            margin-top: 5px;
            text-align: justify;
        }
        .tech-tags {
            margin-top: 5px;
            display: flex;
            flex-wrap: wrap;
        }
        .tech-tag {
            background-color: #f1f1f1;
            border-radius: 3px;
            padding: 2px 6px;
            margin-right: 5px;
            margin-bottom: 5px;
            font-size: 9pt;
            display: inline-block;
        }
        .bio {
            text-align: justify;
            margin-bottom: 20px;
        }
        .location {
            font-style: italic;
            color: #666;
            font-size: 10pt;
        }
        .page-break {
            page-break-after: always;
        }
        .freelance-badge {
            background-color: #e0f0ff;
            color: #2a3f5f;
            border-radius: 3px;
            padding: 2px 6px;
            font-size: 9pt;
            display: inline-block;
        }
        a {
            color: #2a3f5f;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabecera -->
        <div class="header">
            <h1>{{ $user->name }}</h1>
            <div class="contact-info">
                @if($user->phone)
                    <span>{{ $user->phone }}</span> |
                @endif
                <span>{{ $user->email }}</span>
                @if($user->getTranslation('address', $locale) ?? null)
                    | <span>{{ $user->getTranslation('address', $locale) }}</span>
                @endif
            </div>
            <div class="social-links">
                @if($user->linkedin_url)
                    <a href="{{ $user->linkedin_url }}">LinkedIn</a> |
                @endif
                @if($user->github_url)
                    <a href="{{ $user->github_url }}">GitHub</a> |
                @endif
                @if($user->x_url)
                    <a href="{{ $user->x_url }}">Twitter/X</a>
                @endif
            </div>
        </div>

        <!-- Biografía -->
        @if($user->getTranslation('bio', $locale) ?? null)
            <div class="section">
                <div class="bio">
                    {!! nl2br(e($user->getTranslation('bio', $locale))) !!}
                </div>
            </div>
        @endif

        <!-- Experiencia profesional -->
        @if($experiences->count() > 0)
            <div class="section">
                <h2>{{ __('filament.profile.professional_experience') }}</h2>
                @foreach($experiences as $experience)
                    <div class="experience">
                        <div class="experience-header">
                            <div>
                                <div class="position">
                                    {{ $experience->getTranslation('position', $locale) }}
                                    @if($experience->company_url)
                                        <span class="company">| <a href="{{ $experience->company_url }}" target="_blank">{{ $experience->company }}</a></span>
                                    @else
                                        <span class="company">| {{ $experience->company }}</span>
                                    @endif
                                    @if($experience->is_freelance)
                                        <span class="freelance-badge">Freelance</span>
                                    @endif
                                </div>
                                @if($experience->location)
                                    <div class="location">{{ $experience->location }}</div>
                                @endif
                            </div>
                            <div class="dates">
                                {{ $experience->start_date->format('M Y') }} -
                                {{ $experience->end_date ? $experience->end_date->format('M Y') : __('Presente') }}
                            </div>
                        </div>
                        <div class="description">
                            {!! nl2br(e($experience->getTranslation('description', $locale))) !!}
                        </div>
                        @if($experience->technologies)
                            <div class="tech-tags">
                                @foreach(explode(',', $experience->technologies) as $tech)
                                    <span class="tech-tag">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @if(!$loop->last)
                        <div style="margin-bottom: 15px; border-bottom: 1px dotted #eee;"></div>
                    @endif
                @endforeach
            </div>
        @endif

{{--        @if($experiences->count() > 3)--}}
{{--            <div class="page-break"></div>--}}
{{--        @endif--}}

        <!-- Proyectos -->
        @if($projects->count() > 0)
            <div class="section">
                <h2>{{ __('filament.profile.projects') }}</h2>
                @foreach($projects as $project)
                    <div class="project">
                        <div class="project-header">
                            <div class="position">
                                {{ $project->getTranslation('title', $locale) }}
                                @if($project->url)
                                    <span style="font-weight: normal; font-size: 9pt;">
                                        | <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a>
                                    </span>
                                @endif
                            </div>
                            <div class="dates">
                                @if($project->start_date)
                                    {{ $project->start_date->format('M Y') }} -
                                    {{ $project->end_date ? $project->end_date->format('M Y') : __('Presente') }}
                                @endif
                            </div>
                        </div>
                        <div class="description">
                            {!! nl2br(e($project->getTranslation('description', $locale))) !!}
                        </div>
                        @if($project->technologies)
                            <div class="tech-tags">
                                @foreach(explode(',', $project->technologies) as $tech)
                                    <span class="tech-tag">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @if(!$loop->last)
                        <div style="margin-bottom: 15px; border-bottom: 1px dotted #eee;"></div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
