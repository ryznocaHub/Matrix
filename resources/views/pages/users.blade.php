@extends('master')

@section('title', 'Users')

@section('content')
<div class="flex flex-row">
    @foreach($users as $user)
        <div class="px-10 pt-5 mx-10 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center pb-10">
                {{-- <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"> --}}
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->staffName}}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{$user->staffId}}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{$user->email}}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{$user->departureName}}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{$user->position}}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{$user->salary}} {{$user->currency}} 
                </span>
                <a href="{{$user->resume}}" download class="text-sm text-blue-500 dark:text-gray-400">
                    download resume
                </a>
                @if(Auth::user()->role == 1)
                <div class="flex mt-4 space-x-3 md:mt-6">
                    <a href="{{route('users.edit',$user->id)}}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                    <a href="{{route('users.destroy',$user->id)}}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Delete</a>
                </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

@endsection