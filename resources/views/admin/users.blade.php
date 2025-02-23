<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>utilisateurs</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('utilisateurs') }}
            </h2>
        </x-slot>





        <div class="py-12">
            
            <div class="container1" >

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Projets</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="centered">{{ $user->name}}</td>
                                <td class="centered">{{ $user->email }}</td>
                                <td class="centered"> @if($user->projects && $user->projects->isNotEmpty())
                                    {{ $user->projects->pluck('title')->implode(', ') }}
                                @else
                                    Aucun projet
                                @endif</td>
                                <td class="centered">
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;" class="delete-user-form" onsubmit="return confirmDeleteuser()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button2 delete" data-id="{{ $user->id }}">
                                           Supprimer
                                        </button>
                                    </form>
                                    

                                    
                                    
                                  

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
            $('#example').DataTable({
                responsive: true,

                columnDefs: [
                    { orderable: false, targets: [3] } // Désactiver le tri sur la colonne "Actions"
                ]
            });
        });
    </script>

</body>






</html>