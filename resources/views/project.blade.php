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
                {{ __('Projets') }}
            </h2>
        </x-slot>





        <div class="py-12">
            <div class="container" style="display: flex; justify-content: center;margin: 10px 0;">
                <a href="{{ route('project.create') }}" class="button1">Nouveau projet</a>
            </div>




            <div class="container1" >

                <table id="project" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Date Limite</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td class="centered">{{ $project->title }}</td>
                                <td class="centered">{{ $project->description }}</td>
                                <td class="centered">{{ $project->deadline }}</td>
                                <td class="centered">{{ $project->status }}</td>
                                <td class="centered">
                                    <a href="{{ route('admin.project.edit', $project->id) }}" class="button3">Editer</a>

                                    <form action="{{ route('admin.project.destroy', $project->id) }}" method="POST"
                                        style="display: inline-block;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button2">Effacer</button>
                                    </form>
                                    @if($project->status === 'En cours')
                                        <form action="{{ route('admin.project.complete', $project->id) }}" method="POST"
                                            style="display: inline-block;" class="complete-form">
                                            @csrf
                                            <button type="button" class="button1 complete-button"
                                                data-id="{{ $project->id }}">Finir</button>
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
        $(document).ready(function () {
            $('#project').DataTable({
                responsive: true,

                columnDefs: [
                    { orderable: false, targets: [4] } // Désactiver le tri sur la colonne "Actions"
                ]
            });
        });
    </script>

</body>






</html>