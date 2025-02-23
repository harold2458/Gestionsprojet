<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Tâche</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Modifier la tâche : {{ $task->title }}
            </h2>
        </x-slot>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif






        <div class="p-6 text-gray-900 dark:text-gray-100">

            <form action="{{ route('task.update', $task->id) }}" method="POST" class="form1">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" style="color:white">Titre</label>
                    <input type="text" name="title" id="title"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="{{ old('title', $task->title) }}" required>
                </div>

                <div class="mb-4">
                    <label style="color:white"for="description">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="{{ old('description') }}"> {{ old('description') ?? (isset($task->description) ? $task->description : '') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="assigned_to" style="color:white">Attribué à</label>
                    <select name="assigned_to" id="assigned_to"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="project_id" style="color:white">Dans le projet </label>
                    <select name="project_id" id="project_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="priority" style="color:white">Priorité</label>
                    <select name="priority" id="priority"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="Basse">Basse</option>
                        <option value="Moyenne">Moyenne</option>
                        <option value="Haute">Haute</option>
                    </select>
                </div>



                <div class="mb-4">
                    <label for="status" style="color:white">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="Non commencé">Non commencé</option>
                        <option value="En cours">En cours</option>
                    </select>
                </div>


                <div class="flex justify-end" style="display: flex; justify-content: center;margin: 10px 0;">
                    <button type="submit" class="button1">
                        Sauvegarder
                    </button>
                </div>
            </form>

        </div>



    </x-app-layout>


</body>






</html>
