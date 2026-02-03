<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SkillUpx' }}</title>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes growWidth {
            from { width: 0; }
        }

        @keyframes growHeight {
            from { height: 0; }
        }

        .animate-slide-up {
            animation: slideInUp 0.2s ease-out forwards;
        }

        .animate-fade-in {
            animation: fadeIn 0.2s ease-out forwards;
        }

        .progress-bar-animate {
            animation: growWidth 0.5s ease-out forwards;
        }

        .bar-fill-animate {
            animation: growHeight 0.2s ease-out forwards;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased">
{{ $slot }}

<script>
    // Animate progress bars on load
    window.addEventListener('load', () => {
        // Reset and animate progress bars
        document.querySelectorAll('.progress-bar-animate').forEach((bar, index) => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100 + (index * 100));
        });

        // Reset and animate chart bars
        document.querySelectorAll('.bar-fill-animate').forEach((bar, index) => {
            const height = bar.style.height;
            bar.style.height = '0%';
            setTimeout(() => {
                bar.style.height = height;
            }, 200 + (index * 100));
        });
    });
</script>

@livewireScripts

</body>
</html>
