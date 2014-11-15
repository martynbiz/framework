<ol class="breadcrumb">
    <li class="active">Accounts</li>
</ol>

<table class="table table-striped">
    <thead>
        <tr>
            <th>name</th>
            <th>amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{# accounts }}
            <tr>
                <td>{{ name }}</td>
                <td>{{ amount }}</td>
                <td>
                    <a href="/accounts/{{ id }}" data-data="/accounts/{{ id }}" data-template="/templates/accounts/show.php">Show</a> |
                    <a href="/accounts/{{ id }}/edit" data-data="/accounts/{{ id }}" data-template="/templates/accounts/update.php">Edit</a> |
                    <a href="/accounts/{{ id }}/delete" data-data="/accounts/{{ id }}" data-template="/templates/accounts/delete.php">Delete</a>
                </td>
            </tr>
        {{/ accounts }}
    </tbody>
</table>

<div>
    <a href="/accounts/create" class="btn btn-primary" role="button" data-action="new_account">New</a>
</div>