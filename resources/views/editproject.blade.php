<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Projets</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Modifier le projet : {{ $project->title }}
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
                
                    <form action="{{ route('admin.project.update', $project->id)}}" method="POST" class="form1">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label style="color: white;" for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="{{ old('title', $project->title) }}" required>
                        </div>

                        <div class="mb-4">
                            <label style="color: white;" for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $project->description) }}</textarea>
                        </div>


                        <div class="mb-4">
                            <label style="color: white;"  for="deadline" >Date limite</label>
                            <input type="date" name="deadline" id="deadline"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="{{ old('deadline', $project->deadline) }}" required>
                        </div>


                        <div class="mb-4">
                            <label style="color: white;" for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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