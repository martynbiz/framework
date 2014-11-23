<?php

namespace App\Controller;

/**
* Handkes homepage, about etc
*/
class AccountsController extends BaseController
{
    function indexAction()
    {
        // get accounts
        $user = $this->getCurrentUser();
        
        $accounts = $user->accounts;
        
        // return accounts
        return array(
            'accounts' => $accounts->toArray(),
        );
    }
    
    function showAction($id)
    {
        // get account -- add some functionality to Rowset to query that
        $account = $this->getUserAccountById($id);
        
        // return account
        return $account->toArray();
    }
    
    function createAction()
    {
        
    }
    
    function editAction($id)
    {
        // get account -- add some functionality to Rowset to query that
        $account = $this->getUserAccountById($id);
        
        // return account
        return $account->toArray();
    }
    
    function deleteAction($id)
    {
        // get account -- add some functionality to Rowset to query that
        $account = $this->getUserAccountById($id);
        
        // return account
        return $account->toArray();
    }
    
    function getUserAccountById($id)
    {
        $user = $this->getCurrentUser();
        $accounts = $user->accounts;
        $found = false;
        foreach($accounts as $account) {
            // check if the requested account is here
            if($account->id == $id) {
                $found = true;
                break;
            }
        }
        
        // if not found, throw excpetion
        if(! $found )
            throw new Exception('ID not found');
        
        return $account;
    }
}