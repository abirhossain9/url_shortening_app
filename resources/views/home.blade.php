@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('url.store') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="url" class="form-control" placeholder="Enter URL">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Generate short url</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>Short Url</th>
                                <th>Url</th>
                                <th>Click count</th>
                            </tr>
                            </thead>
                            @if(count($shortUrls) > 0)
                                <tbody>
                                    @foreach($shortUrls as $shortUrl)
                                        <tr>
                                            <td>{{$shortUrl->url}}</td>
                                            <td><a href="{{url($shortUrl->short_code)}}">{{url($shortUrl->short_code)}}</a></td>
                                            <td>{{$shortUrl->click_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
