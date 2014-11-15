<ol class="breadcrumb">
    <li><a href="/accounts" data-data="/accounts" data-template="/templates/accounts/index.php">Accounts</a></li>
    <li class="active">create</li>
</ol>

<form method="POST" action="/accounts" name="accounts_create">
    <?php include '_form.php'; ?>
    
    <input type="submit" name="submit" value="Save" class="btn btn-primary" role="button">
</form>