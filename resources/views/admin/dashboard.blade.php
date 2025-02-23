<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">

    </div>






    <div class="container mx-auto p-6">


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-4 bg-white shadow-md rounded-lg"style="background-color:#1F2937ff;color:white">
                <h2 class="font-semibold text-lg">Total des utilisateurs</h2>
                <p class="text-4xl font-bold">{{ $totalUsersCount }}</p>
            </div>


            <div class="p-4 bg-white shadow-md rounded-lg"style="background-color:#1F2937ff;color:white">
                <h2 class="font-semibold text-lg">Total des Projets</h2>
                <p class="text-4xl font-bold">{{ $ProjectsCount }}</p>
            </div>
            <div class="p-4 bg-white shadow-md rounded-lg"style="background-color:#1F2937ff;color:white">
                <h2 class="font-semibold text-lg">Projets Terminés</h2>
                <p class="text-4xl font-bold">{{ $completedProjectsCount }}</p>
            </div>
            @foreach (auth()->user()->unreadNotifications as $notification)
                <div class="p-4 bg-white shadow-md rounded-lg"style="background-color:#1F2937ff;color:white">
                  <p class="notif">Notification</p>
                    <p>Nouvelle Tâche: {{ $notification->data['task_title'] }}</p>
                    <p>Attribué par: {{ $notification->data['assigned_by'] }}</p>
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="button1">Seen</button>
                    </form>
                </div>
            @endforeach
            
        </div>
    </div>
</x-app-layout>
