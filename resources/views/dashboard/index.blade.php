@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">
</div>
</div>
    <div class="container">
        <div class="container-2" style="margin-left: -50px;">
            <div class="dashboard">
                <h2><b>Dashboard <div class="garis-vertikal"></div> Sehat Bersama Posyandu</b></h2>
            </div>
            <div class="hi">
                <h3>Halo Admin !</h3>
            </div>
        </div>
        <div class="sidebar">
            <li><img src="/homeIcon.svg"><a href="{{url('dashboard/')}}">Dashboard</a></li>
            <li><img src="/profil.svg"><a href="#">Profil</a></li>
            <li><img src="/vaksin.svg"><a href="{{url('dashboard/bayi')}}">Pencatatan Bayi</a></li>
            <li><img src="/imunisasi.svg"><a href="{{url('dashboard/catatan_imunisasi')}}">Pencatatan Ibu Hamil</a></li>
            <li><img src="/jadwal.svg"><a href="#">Jadwal Posyandu</a></li>
            <li><img src="/user.svg"><a href="{{url('dashboard/user')}}">Kelola User</a></li>
            <li><img src="/activity.svg"><a href="{{url('dashboard/log_bayi')}}">Log Bayi</a></li>
        </div>
        <div class="row">
            @if(auth()->user()->role == 'admin')
                <div class="col-3">
                    <a href="{{url('dashboard/user')}}" class="text-decoration-none">
                        <div class="cardPosyandu">
                            <img src="user.svg"> 
                            <h1 style="font-size: 15px">Kelola User</h1>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="{{url('dashboard/catatan_imunisasi')}}" class="text-decoration-none">
                        <div class="cardPosyandu">
                            <img src="imunisasi.svg">
                            <h1 style="font-size: 15px">Pencatatan Ibu Hamil</h1>
                        </div>
                    </a>
                </div>
            @endif
            <div class="col-3">
                <a href="{{url('dashboard/bayi')}}" class="text-decoration-none">
                    <div class="cardPosyandu">
                        <img src="vaksin.svg">
                        <h1 style="font-size: 15px">Pencatatan Bayi</h1>
                    </div>
                </a>
            </div>
            
            <div class="col-3">
                <a href="{{url('dashboard/log')}}" class="text-decoration-none">
                    <div class="cardPosyandu">
                        <img src="activity.svg">
                        <h1 style="font-size: 15px">Log</h1>
                    </div>
                </a>
            </div>
        </div>
 

    </div>
@endsection
