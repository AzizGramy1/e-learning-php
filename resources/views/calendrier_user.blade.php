<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning - EduTech</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <style>
        /* Styles cohérents avec le thème EduTech */
        .gradient-bg {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        }
        .sidebar-bg {
            background: rgba(26, 32, 44, 0.95);
            backdrop-filter: blur(10px);
        }
        .text-gradient {
            background: linear-gradient(90deg, #3B82F6, #10B981);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }
        .glow-on-hover {
            transition: all 0.3s ease;
        }
        .glow-on-hover:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }
        .btn-press {
            transition: all 0.2s ease;
        }
        .btn-press:active {
            transform: scale(0.98);
        }
        .planning-card {
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.8) 0%, rgba(26, 32, 44, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
        }
        .fc-theme-standard .fc-scrollgrid,
        .fc-theme-standard .fc-scrollgrid-section-body,
        .fc-theme-standard .fc-scrollgrid-section-footer {
            border-color: rgba(74, 85, 104, 0.5);
        }
        .fc-theme-standard .fc-scrollgrid-section-header {
            border-color: rgba(74, 85, 104, 0.8);
        }
        .fc .fc-daygrid-day.fc-day-today {
            background-color: rgba(59, 130, 246, 0.15);
        }
        .fc .fc-button {
            background-color: #3B82F6;
            border-color: #3B82F6;
            transition: all 0.3s ease;
        }
        .fc .fc-button:hover {
            background-color: #2563EB;
            border-color: #2563EB;
        }
        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #1D4ED8;
            border-color: #1D4ED8;
        }
        .fc-event {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .fc-event:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .event-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background-color: rgba(31, 41, 55, 0.3);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .animate-pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body class="gradient-bg text-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
                <span class="text-2xl font-bold text-gradient">EduTech</span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Accueil</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Cours</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Quiz</a>
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Planning</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Profil</a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-8 h-8 rounded-full border-2 border-blue-500">
                        <span class="hidden md:inline text-gray-300">Marie</span>
                    </button>
                </div>
                <button class="md:hidden text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Upcoming Events -->
            <div class="lg:w-1/3">
                <div class="planning-card p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Prochains événements
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- Event 1 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 animate__animated animate__fadeInLeft">
                            <div class="flex items-start">
                                <div class="bg-blue-600 text-white text-xs px-2 py-1 rounded mr-3 mt-1">
                                    10:00
                                </div>
                                <div>
                                    <h3 class="font-medium flex items-center">
                                        <span class="event-dot bg-blue-500"></span>
                                        Cours de JavaScript Avancé
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">Les promesses et async/await</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Salle virtuelle #3
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Event 2 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 animate__animated animate__fadeInLeft animate__delay-1s">
                            <div class="flex items-start">
                                <div class="bg-purple-600 text-white text-xs px-2 py-1 rounded mr-3 mt-1">
                                    14:30
                                </div>
                                <div>
                                    <h3 class="font-medium flex items-center">
                                        <span class="event-dot bg-purple-500"></span>
                                        Atelier React
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">Gestion d'état avec Redux</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Salle virtuelle #1
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Event 3 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 animate__animated animate__fadeInLeft animate__delay-2s">
                            <div class="flex items-start">
                                <div class="bg-green-600 text-white text-xs px-2 py-1 rounded mr-3 mt-1">
                                    16:00
                                </div>
                                <div>
                                    <h3 class="font-medium flex items-center">
                                        <span class="event-dot bg-green-500"></span>
                                        Session de mentorat
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">Revue de projet personnel</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Discussion privée
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="planning-card p-6">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Statistiques d'apprentissage
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Heures cette semaine</span>
                            <span class="font-medium">8.5h</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 70%"></div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Cours complétés</span>
                            <span class="font-medium">12/20</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 60%"></div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Quiz réussis</span>
                            <span class="font-medium">85%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-purple-500 h-2.5 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <h3 class="font-medium mb-2">Prochain objectif</h3>
                        <p class="text-sm text-gray-400">Complétez 3 cours cette semaine pour débloquer le badge "Apprenant assidu"</p>
                        <div class="w-full bg-gray-700 rounded-full h-2.5 mt-3">
                            <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 66%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Calendar -->
            <div class="lg:w-2/3">
                <div class="planning-card p-6 h-full">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Mon planning
                        </h2>
                        <div class="flex space-x-2">
                            <button id="add-event" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajouter
                            </button>
                            <button id="today-btn" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm">
                                Aujourd'hui
                            </button>
                        </div>
                    </div>
                    
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <div id="event-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="planning-card p-6 w-full max-w-md">
            <h3 class="text-xl font-bold mb-4" id="modal-title">Détails de l'événement</h3>
            
            <form id="event-form">
                <div class="mb-4">
                    <label for="event-title" class="block text-sm font-medium mb-2">Titre</label>
                    <input type="text" id="event-title" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="event-start" class="block text-sm font-medium mb-2">Début</label>
                        <input type="datetime-local" id="event-start" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="event-end" class="block text-sm font-medium mb-2">Fin</label>
                        <input type="datetime-local" id="event-end" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="event-color" class="block text-sm font-medium mb-2">Couleur</label>
                    <select id="event-color" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="blue">Bleu</option>
                        <option value="red">Rouge</option>
                        <option value="green">Vert</option>
                        <option value="purple">Violet</option>
                        <option value="yellow">Jaune</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="event-description" class="block text-sm font-medium mb-2">Description</label>
                    <textarea id="event-description" rows="3" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-event" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-300">
                        Annuler
                    </button>
                    <button type="button" id="delete-event" class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg transition-colors duration-300 hidden">
                        Supprimer
                    </button>
                    <button type="submit" id="save-event" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg transition-colors duration-300">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                    <span class="text-xl font-bold text-gradient">EduTech</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Conditions</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Contact</a>
                </div>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-500 text-sm">
                <p>© 2024 EduTech. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/fr.min.js"></script>
    <script>
        // Initialize calendar
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                events: [
                    {
                        title: 'JavaScript Avancé',
                        start: new Date().setHours(10, 0, 0),
                        end: new Date().setHours(12, 0, 0),
                        color: '#3B82F6',
                        extendedProps: {
                            description: 'Les promesses et async/await',
                            location: 'Salle virtuelle #3'
                        }
                    },
                    {
                        title: 'Atelier React',
                        start: new Date(new Date().setDate(new Date().getDate() + 1)).setHours(14, 30, 0),
                        end: new Date(new Date().setDate(new Date().getDate() + 1)).setHours(16, 0, 0),
                        color: '#8B5CF6',
                        extendedProps: {
                            description: 'Gestion d\'état avec Redux',
                            location: 'Salle virtuelle #1'
                        }
                    },
                    {
                        title: 'Session de mentorat',
                        start: new Date(new Date().setDate(new Date().getDate() + 2)).setHours(16, 0, 0),
                        end: new Date(new Date().setDate(new Date().getDate() + 2)).setHours(17, 30, 0),
                        color: '#10B981',
                        extendedProps: {
                            description: 'Revue de projet personnel',
                            location: 'Discussion privée'
                        }
                    },
                    {
                        title: 'Quiz JavaScript',
                        start: new Date(new Date().setDate(new Date().getDate() + 3)).setHours(9, 0, 0),
                        end: new Date(new Date().setDate(new Date().getDate() + 3)).setHours(10, 0, 0),
                        color: '#F59E0B',
                        extendedProps: {
                            description: 'Test sur les concepts avancés',
                            location: 'Plateforme EduTech'
                        }
                    }
                ],
                eventClick: function(info) {
                    openEventModal(info.event);
                },
                dateClick: function(info) {
                    openEventModal(null, info.date);
                },
                eventContent: function(arg) {
                    return {
                        html: `<div class="fc-event-main-frame">
                            <div class="fc-event-title-container">
                                <span class="fc-event-title">${arg.event.title}</span>
                            </div>
                            <div class="fc-event-time">${arg.timeText}</div>
                        </div>`
                    };
                }
            });
            
            calendar.render();
            
            // Today button
            document.getElementById('today-btn').addEventListener('click', function() {
                calendar.today();
            });
            
            // Event modal elements
            const modal = document.getElementById('event-modal');
            const eventTitle = document.getElementById('event-title');
            const eventStart = document.getElementById('event-start');
            const eventEnd = document.getElementById('event-end');
            const eventColor = document.getElementById('event-color');
            const eventDescription = document.getElementById('event-description');
            const saveButton = document.getElementById('save-event');
            const deleteButton = document.getElementById('delete-event');
            const cancelButton = document.getElementById('cancel-event');
            const addButton = document.getElementById('add-event');
            
            let currentEvent = null;
            
            // Open modal to add new event
            addButton.addEventListener('click', function() {
                openEventModal();
            });
            
            // Open modal with event data
            function openEventModal(event = null, date = null) {
                if (event) {
                    currentEvent = event;
                    document.getElementById('modal-title').textContent = 'Modifier l\'événement';
                    eventTitle.value = event.title;
                    eventStart.value = formatDateTimeForInput(event.start);
                    eventEnd.value = event.end ? formatDateTimeForInput(event.end) : '';
                    eventColor.value = getColorName(event.backgroundColor);
                    eventDescription.value = event.extendedProps.description || '';
                    deleteButton.classList.remove('hidden');
                } else {
                    currentEvent = null;
                    document.getElementById('modal-title').textContent = 'Ajouter un événement';
                    eventTitle.value = '';
                    const startDate = date || new Date();
                    eventStart.value = formatDateTimeForInput(startDate);
                    eventEnd.value = formatDateTimeForInput(new Date(startDate.getTime() + 60 * 60 * 1000));
                    eventColor.value = 'blue';
                    eventDescription.value = '';
                    deleteButton.classList.add('hidden');
                }
                
                modal.classList.remove('hidden');
            }
            
            // Format date for datetime-local input
            function formatDateTimeForInput(date) {
                return date.toISOString().slice(0, 16);
            }
            
            // Get color name from hex value
            function getColorName(hex) {
                const colors = {
                    '#3B82F6': 'blue',
                    '#EF4444': 'red',
                    '#10B981': 'green',
                    '#8B5CF6': 'purple',
                    '#F59E0B': 'yellow'
                };
                return colors[hex] || 'blue';
            }
            
            // Get hex value from color name
            function getHexFromColorName(name) {
                const colors = {
                    'blue': '#3B82F6',
                    'red': '#EF4444',
                    'green': '#10B981',
                    'purple': '#8B5CF6',
                    'yellow': '#F59E0B'
                };
                return colors[name] || '#3B82F6';
            }
            
            // Save event
            saveButton.addEventListener('click', function() {
                const eventData = {
                    title: eventTitle.value,
                    start: new Date(eventStart.value),
                    end: new Date(eventEnd.value),
                    backgroundColor: getHexFromColorName(eventColor.value),
                    extendedProps: {
                        description: eventDescription.value
                    }
                };
                
                if (currentEvent) {
                    currentEvent.setProp('title', eventData.title);
                    currentEvent.setDates(eventData.start, eventData.end);
                    currentEvent.setProp('backgroundColor', eventData.backgroundColor);
                    currentEvent.setExtendedProp('description', eventData.extendedProps.description);
                } else {
                    calendar.addEvent(eventData);
                }
                
                modal.classList.add('hidden');
            });
            
            // Delete event
            deleteButton.addEventListener('click', function() {
                if (currentEvent) {
                    currentEvent.remove();
                    modal.classList.add('hidden');
                }
            });
            
            // Cancel modal
            cancelButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    </script>
</body>
</html>