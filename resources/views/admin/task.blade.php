<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Tâches</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tâches') }}
            </h2>
        </x-slot>





        <div class="py-12">
            <div class="container" style="display: flex; justify-content: center;margin: 10px 0;">
                ">
                <a href="{{ route('admin.task.create') }}" class="button1">Nouvelle tâche</a>
            </div>




            <div class="container1 ">

                <table id="task" class="display" cellspacing="0"
                    style="background-color:   #1F2937ff!important"width="100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Créé par</th>
                            <th>Attribué à</th>
                            <th>Dans le projet</th>
                            <th>Priorité</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="centered">{{ $task->title }}</td>
                                <td class="centered">{{ $task->description }}</td>
                                <td class="centered">{{ $task->createdBy->name }}</td>
                                <td class="centered">{{ $task->assignedTo->name }}</td>
                                <td class="centered">{{ $task->project->title }}</td>
                                <td class="centered">{{ $task->priority }}</td>
                                <td class="centered">{{ $task->status }}</td>

                                <td class="centered">
                                   
                                        <a href="{{ route('admin.task.edit', $task->id) }}" class="button3">Editer</a>

                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST"
                                            style="display: inline-block;" onsubmit="return confirmDeletetask()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button2">Effacer</button>
                                        </form>
                                   
                                    @if ($task->status === 'En cours')
                                        <form action="{{ route('admin.task.complete', $task->id) }}" method="POST"
                                            style="display: inline-block;" class="complete-form1">
                                            @csrf
                                            <button type="button" class="button1 complete-button1"
                                                data-id="{{ $task->id }}">Finir</button>
                                        </form>
                                    @endif
                                    @if ($task->status === 'Non commencé')
                                        <form action="{{ route('admin.task.started', $task->id) }}" method="POST"
                                            style="display: inline-block;" class="complete-form2">
                                            @csrf
                                            <button type="button" class="button1 complete-button2"
                                                data-id="{{ $task->id }}">Initier</button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </x-app-layout>
    <script>
        $(document).ready(function() {
            $('#task').DataTable({
                responsive: true,

                columnDefs: [{
                    orderable: false,
                    targets: [7]
                }]
            });
        });
    </script>

</body>






</html>
