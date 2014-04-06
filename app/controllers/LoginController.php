<?php

class LoginController extends BaseController {
 
  /**
   * User Repository
   */
  protected $user;
 
  /**
   * Inject the User Repository
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }
 
  /**
   * Show the form for creating a new Login
   */
  public function create()
  {
    return View::make('Login.create');
  }
 
  public function store()
  {
    if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
    {

      return Redirect::intended('/');
    }
    return Redirect::to('/')
            ->withInput()
            ->with('login_errors', true);
  }
 
  public function destroy()
  {
    Auth::logout();
 
    return View::make('Login.destroy');
  }
 
}