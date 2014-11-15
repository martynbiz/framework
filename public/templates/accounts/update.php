<ol class="breadcrumb">
    <li><a href="/accounts" data-data="/accounts" data-template="/templates/accounts/index.php">Accounts</a></li>
    <li><a href="/accounts/{{ id }}" data-data="/accounts/{{ id }}" data-template="/templates/accounts/show.php">{{ name }}</a></li>
    <li class="active">edit</li>
</ol>

<form method="POST" action="/accounts/{{ id }}" name="accounts_update">
    <?php include '_form.php'; ?>
    
    <input type="hidden" name="_METHOD" value="PUT"/>
    
    <input type="submit" name="submit" value="Save" class="btn btn-primary" role="button">
            <a href="/accounts/{{ id }}" class="btn btn-default" data-data="/accounts/{{ id }}" data-template="/templates/accounts/show.php">Cancel</a>
</form>