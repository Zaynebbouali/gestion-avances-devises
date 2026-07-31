@extends('layouts.admin')
@section('content')

<h2>Gestion des utilisateurs</h2>
<button class="btn btn-success"
data-bs-toggle="modal"
data-bs-target="#addUserModal">

Ajouter un utilisateur

</button>
<br><br>
<table class="table table-bordered">
<tr>

<th>ID</th>
<th>Nom</th>
<th>Login</th>
<th>Rôle</th>
<th>Actions</th>

</tr>



@foreach($users as $user)


<tr>


<td>{{ $user->id }}</td>

<td>{{ $user->nom }}</td>

<td>{{ $user->login }}</td>

<td>{{ $user->role }}</td>
<td>


<button class="btn btn-warning editUser"

data-bs-toggle="modal"
data-bs-target="#editUserModal"

data-id="{{ $user->id }}"
data-nom="{{ $user->nom }}"
data-login="{{ $user->login }}"
data-role="{{ $user->role }}">

Modifier

</button>

<button class="btn btn-danger deleteUser"

data-bs-toggle="modal"
data-bs-target="#deleteUserModal"

data-id="{{ $user->id }}">
Supprimer</button>



</td>


</tr>


@endforeach


</table>
{{ $users->links() }}

<div class="modal fade" id="addUserModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5>Ajouter utilisateur</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="{{ route('users.store') }}" method="POST">
@csrf
<div class="modal-body">


<label>Nom</label>
<input class="form-control" name="nom" required>

<label>Login</label>
<input class="form-control" name="login" required>

<label>Mot de passe</label>
<input class="form-control" type="password" name="password" required>

<label>Rôle</label>
<select class="form-control"name="role">

<option value="admin">Admin</option>
<option value="dcoa">DCOA</option>
<option value="dgf">DGF</option>
<option value="dcsp">dcsp</option>


</select>
</div>

<div class="modal-footer">
<button class="btn btn-success">Enregistrer</button>
</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="editUserModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">

<h5>Modifier utilisateur</h5>

<button class="btn-close"
data-bs-dismiss="modal">
</button>

</div>
<form id="editForm" method="POST">


@csrf

@method('PUT')
<div class="modal-body">


<label>Nom</label>
<input id="edit_nom" class="form-control" name="nom">

<label>Login</label>
<input id="edit_login" class="form-control" name="login">

<label>Nouveau mot de passe</label>
<input class="form-control" type="password" name="password">

<label>Rôle</label>
<select id="edit_role" class="form-control" name="role">

<option value="admin">Admin</option>

<option value="dcoa">DCOA</option>

<option value="dgf">DGF</option>

<option value="dcsp">DCSP</option>


</select>
</div>
<div class="modal-footer">
<button class="btn btn-warning">Modifier</button>

</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="deleteUserModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">

<h5>Supprimer utilisateur</h5>

<button class="btn-close"
data-bs-dismiss="modal">
</button>

</div>
<form id="deleteForm" method="POST">
@csrf

@method('DELETE')
<div class="modal-body">Voulez-vous supprimer cet utilisateur ?</div>

<div class="modal-footer">
<button class="btn btn-danger">Supprimer</button>

</div>
</form>
</div>
</div>
</div>

<script>
document.querySelectorAll('.editUser')
.forEach(button=>{


button.onclick=function(){

document.getElementById('edit_nom').value =
this.dataset.nom;


document.getElementById('edit_login').value =
this.dataset.login;


document.getElementById('edit_role').value =
this.dataset.role;



document.getElementById('editForm').action =
"/users/"+this.dataset.id;


}



});



document.querySelectorAll('.deleteUser')
.forEach(button=>{


button.onclick=function(){


document.getElementById('deleteForm').action =
"/users/"+this.dataset.id;


}


});



</script>



@endsection