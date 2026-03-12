@extends('layouts.app')

@section('title', 'Éditer - ' . $stade->nom)

@section('content')
<a href="{{ route('stades.index') }}" class="btn btn-secondary mb-3">← Retour</a>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-warning text-white">
        <h4 class="mb-0">✏️ Éditer le Stade</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('stades.update', $stade->id) }}" method="POST">
          @csrf @method('PUT')

          <div class="mb-3">
            <label class="form-label"><strong>Nom *</strong></label>
            <input type="text" name="nom" class="form