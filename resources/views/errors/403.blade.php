@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', 'VERBODEN!')
@section('message', __($exception->getMessage() ?: 'Je mag hier niet komen.'))
