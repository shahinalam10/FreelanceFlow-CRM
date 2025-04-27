<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreelanceFlow CRM</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                screens: {
                    'xs': '375px',
                    'sm': '640px',
                    'md': '768px',
                    'lg': '1024px',
                    'xl': '1280px',
                    '2xl': '1536px',
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                    heading: ['Manrope', 'sans-serif'],
                },
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#4361ee',
                            hover: '#3a56d4'
                        },
                        secondary: {
                            DEFAULT: '#3f37c9',
                            hover: '#3830b5'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .text-gradient {
                @apply bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary;
            }
            .transition-smooth {
                @apply transition-all duration-300 ease-in-out;
            }
            .card-hover {
                @apply hover:shadow-lg hover:-translate-y-1 transform transition-smooth;
            }
            /* Responsive typography */
            .text-hero {
                @apply text-3xl xs:text-4xl sm:text-5xl lg:text-6xl;
            }
            .text-section-title {
                @apply text-2xl sm:text-3xl md:text-4xl;
            }
            .text-feature-title {
                @apply text-lg sm:text-xl;
            }
        }
        
        /* Custom animations */
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(67, 97, 238, 0); }
            100% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0); }
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm sticky top-0 z-50 animate__animated animate__fadeIn">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xs:h-8 xs:w-8 text-primary" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{route('home')}}" class="text-xl xs:text-2xl font-heading font-bold text-gradient">FreelanceFlow</a>
                </div>
                <div class="flex items-center space-x-2 xs:space-x-4">
                    <button id="themeToggle" class="p-1 xs:p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition-smooth" aria-label="Toggle dark mode">
                        <svg id="themeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path id="themeIconPath" fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="authButtons" class="flex space-x-1 xs:space-x-2">
                        <a href="{{route('login')}}" class="px-2 xs:px-4 py-1 xs:py-2 text-sm xs:text-base border border-primary text-primary rounded-lg hover:bg-blue-50 dark:border-blue-400 dark:text-blue-400 dark:hover:bg-gray-700 transition-smooth font-medium">Login</a>
                        <a href="{{route('register')}}" class="px-2 xs:px-4 py-1 xs:py-2 text-sm xs:text-base bg-primary text-white rounded-lg hover:bg-primary-hover dark:bg-blue-700 dark:hover:bg-blue-800 transition-smooth font-medium">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section - Responsive Layout -->
    <main class="container mx-auto px-4 py-8 sm:py-12 md:py-16 lg:py-20">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8 md:gap-12">
            <!-- Text Content - Responsive Ordering -->
            <div class="lg:w-1/2 order-2 lg:order-1 animate__animated animate__fadeIn animate__delay-1s">
                <h1 class="text-hero font-heading font-bold mb-4 md:mb-6 leading-tight">
                    <span class="text-gradient">Streamline</span> Your Freelance Business
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-6 md:mb-8 leading-relaxed">
                    FreelanceFlow CRM helps you manage clients, projects, and payments all in one place. 
                    Designed specifically for freelancers who value simplicity and efficiency.
                </p>
                <div class="flex flex-col xs:flex-row gap-3 sm:gap-4">
                    <a href="{{route('register')}}" id="ctaButton" class="px-4 sm:px-6 py-2 sm:py-3 bg-primary text-white rounded-lg hover:bg-primary-hover dark:bg-blue-700 dark:hover:bg-blue-800 text-base sm:text-lg font-medium transition-smooth shadow-md hover:shadow-lg animate-pulse-glow">
                        Get Started - It's Free
                    </a>
                    <a href="/features" class="px-4 sm:px-6 py-2 sm:py-3 border border-gray-300 rounded-lg hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-800 text-base sm:text-lg font-medium transition-smooth flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        Watch Demo
                    </a>
                </div>
                <div class="mt-6 sm:mt-8 flex flex-col xs:flex-row xs:items-center space-y-3 xs:space-y-0 xs:space-x-4">
                    <div class="flex -space-x-2">
                        <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-white dark:border-gray-800" src="https://randomuser.me/api/portraits/women/12.jpg" alt="User">
                        <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-white dark:border-gray-800" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                        <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-white dark:border-gray-800" src="https://randomuser.me/api/portraits/women/45.jpg" alt="User">
                    </div>
                    <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                        <p>Trusted by <span class="font-semibold text-gray-700 dark:text-gray-300">5000+</span> freelancers</p>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">4.9/5 (1,200+ reviews)</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image Content - Responsive Ordering -->
            <div class="lg:w-1/2 order-1 lg:order-2 mb-8 lg:mb-0 animate__animated animate__fadeIn animate__delay-2s">
                <div class="relative">
                    <div class="absolute -inset-2 sm:-inset-3 md:-inset-4 bg-gradient-to-r from-primary to-secondary rounded-xl md:rounded-2xl opacity-20 blur-lg md:blur-xl"></div>
                    <div class="relative p-1 rounded-xl md:rounded-2xl shadow-lg md:shadow-2xl bg-white dark:bg-gray-800 overflow-hidden">
                        <img src="{{asset('frontendAsset')}}/assets/img/dashboardp.png" alt="FreelanceFlow Dashboard" class="rounded-lg md:rounded-xl w-full h-auto animate-float">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section - Responsive Grid -->
    <section class="py-12 md:py-16 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16 animate__animated animate__fadeIn">
                <span class="inline-block px-2 py-1 text-xs sm:text-sm font-medium rounded-full bg-primary/10 text-primary dark:bg-blue-900/30 dark:text-blue-400 mb-3 sm:mb-4">
                    Powerful Features
                </span>
                <h2 class="text-section-title font-heading font-bold mb-3 sm:mb-4">
                    Everything You Need to <span class="text-gradient">Succeed</span>
                </h2>
                <p class="max-w-2xl mx-auto text-sm sm:text-base md:text-lg text-gray-600 dark:text-gray-300">
                    FreelanceFlow provides all the tools you need to manage your freelance business efficiently.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="animate__animated animate__slide-up animate__delay-1s bg-white dark:bg-gray-800 rounded-lg md:rounded-xl shadow-md overflow-hidden card-hover border border-gray-100 dark:border-gray-700">
                    <div class="p-4 sm:p-5 md:p-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg md:rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center mb-4 sm:mb-5 md:mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                            </svg>
                        </div>
                        <h3 class="text-feature-title font-heading font-semibold mb-2 sm:mb-3">Client Management</h3>
                        <p class="text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-400 mb-3 sm:mb-4">
                            Organize all client details in one place with custom tags, notes, and interaction history.
                        </p>
                        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Contact details & company info
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Custom fields & tags
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Interaction history
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="animate__animated animate__slide-up animate__delay-2s bg-white dark:bg-gray-800 rounded-lg md:rounded-xl shadow-md overflow-hidden card-hover border border-gray-100 dark:border-gray-700">
                    <div class="p-4 sm:p-5 md:p-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg md:rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900/30 dark:to-purple-800/30 flex items-center justify-center mb-4 sm:mb-5 md:mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                            </svg>
                        </div>
                        <h3 class="text-feature-title font-heading font-semibold mb-2 sm:mb-3">Project Tracking</h3>
                        <p class="text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-400 mb-3 sm:mb-4">
                            Manage projects from proposal to delivery with timelines, budgets, and task management.
                        </p>
                        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Budget & time tracking
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Task management
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                File sharing & collaboration
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="animate__animated animate__slide-up animate__delay-3s bg-white dark:bg-gray-800 rounded-lg md:rounded-xl shadow-md overflow-hidden card-hover border border-gray-100 dark:border-gray-700">
                    <div class="p-4 sm:p-5 md:p-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg md:rounded-xl bg-gradient-to-br from-green-100 to-green-50 dark:from-green-900/30 dark:to-green-800/30 flex items-center justify-center mb-4 sm:mb-5 md:mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-feature-title font-heading font-semibold mb-2 sm:mb-3">Interaction Logs</h3>
                        <p class="text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-400 mb-3 sm:mb-4">
                            Record every client interaction with automated email tracking and meeting notes.
                        </p>
                        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Call & meeting logging
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Email tracking
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Customizable templates
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="animate__animated animate__slide-up animate__delay-4s bg-white dark:bg-gray-800 rounded-lg md:rounded-xl shadow-md overflow-hidden card-hover border border-gray-100 dark:border-gray-700">
                    <div class="p-4 sm:p-5 md:p-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg md:rounded-xl bg-gradient-to-br from-orange-100 to-orange-50 dark:from-orange-900/30 dark:to-orange-800/30 flex items-center justify-center mb-4 sm:mb-5 md:mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-feature-title font-heading font-semibold mb-2 sm:mb-3">Reminders</h3>
                        <p class="text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-400 mb-3 sm:mb-4">
                            Never miss a deadline with smart reminders and follow-up notifications.
                        </p>
                        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Smart reminders
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Recurring tasks
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-green-500 mr-1 sm:mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Email & mobile notifications
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer - Responsive Layout -->
    <footer class="py-6 sm:py-8 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-primary" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-lg sm:text-xl font-heading font-bold text-gradient">FreelanceFlow</span>
                </div>
                <div class="flex flex-col items-center md:flex-row md:space-x-4 lg:space-x-6 space-y-2 md:space-y-0 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                    <p>© <span id="currentYear"></span> FreelanceFlow CRM. All rights reserved.</p>
                    <div class="flex space-x-3 sm:space-x-4">
                        <a href="#" class="hover:text-primary transition-smooth">Privacy</a>
                        <a href="#" class="hover:text-primary transition-smooth">Terms</a>
                        <a href="#" class="hover:text-primary transition-smooth">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset('frontendAsset')}}/assets/js/main.js"></script>
</body>
</html>