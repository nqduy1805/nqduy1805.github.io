                                          <a>123</a>

          <a class="dropdown-item"
                   onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
            </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="submit" value="Sign In" name="login">
                                    </form>
