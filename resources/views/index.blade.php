<x-layout content>
    @auth
    <section id="mainOutput">
        <span class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}!</span>
        <button onclick="logout()">Logout</button>
        <div class="container">
            <br>
            <section id="search-box">
                <form method="GET" action="/">
                    {{ Session::get('token') }}
                    <input type="text" name="query" placeholder="Search" class="bg-transparent placeholder-black font-semibold text-sm border" onkeyup="searchUser(this.value)">
                </form>
            </section>
            <br>
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal">
                  Add New User
                </button>
            </div>
            <hr>
            <div id="output" class="">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Hobby</th>
                            <th scope="col">Address</th>
                            <th scope="col">Images</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Edited By</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->hobby }}</td>
                            <td>{{ $user->address }}</td>
                            <td><img src="Image/{{ $user->image }}" alt="#"></td>
                            <td>{{ $user->created_By }}</td>
                            <td>{{ $user->edited_By }}</td>
                            <td>
                                <button onclick="editData({{ $user->id }})" type="button" class="btn btn-primary">
                                  Edit
                                </button>
                                <button type="button" class="btn btn-danger" onclick="deleteUser({{ $user->id }})">
                                  Delete
                                </button>
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
        <x-new-modal />
        <x-edit-modal />
        @if (session()->has('success'))
        <div x-data="{show:true}"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show" class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
            <p>{{ session('success') }}</p>
        </div>
        @endif
    </section>
    @else
    <section id="mainOutput">
        <button onclick="viewRegister()">Register</button>|
        <button onclick="viewLogin()">Login</button>
    </section>
    @endauth
</x-layout>