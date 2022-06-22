<div class="tab-pane" id="doc_personales">
    <div class="row">
        <div class="col-md-6">
            <div class="timeline timeline-inverse">
                <div class="time-label">
                  <span class="bg-danger">
                    Documentos Personales
                  </span>
                  <span class="">
                    <a href="{{route('documento_personal.create',$trabajador->id)}}" class="btn btn-success">
                    <i class="fa fa-plus"></i></a>
                  </span>
                </div>

                <div class="col-md-12">
                    @forelse ($trabajador->documentos_personales as $doc_personal  )
                        @if ($doc_personal->tipo_documento=='personal')
                            <i class="fas fa-file-pdf bg-danger"></i>
                            <div class="timeline-item">
                                {{-- <span class="time"><i class="far fa-clock"></i> 12:05</span> --}}
                                <h3 class="timeline-header">
                                    <b><a href="#">Documento</a> :{{$doc_personal->detalle_documento}} </b>
                                </h3>
                                <div class="timeline-body">
                                    <b>Fecha de registro:</b>{{$doc_personal->fecha_registro->format('d/m/Y')}} <br>
                                </div>
                                <div class="timeline-footer">
                                    @if (($doc_personal->file_documento)!="")
                                        <button type="button" class='btn btn-primary btn-icon btn-xs' data-id="{{encrypt($doc_personal->id)}}" id="ViewModalDocumentoPersonal">
                                            Ver Documento <i class="fas fa-file-pdf"></i>
                                        </button>
                                    @else
                                        <p>Sin Documento</p>
                                    @endif
                                </div>
                            </div><br>
                        @endif
                      @empty
                        <p>No hay Documentos registrados.</p>
                    @endforelse
                </div>
                <div>
                  <i class="far fa-clock bg-gray"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="timeline timeline-inverse">
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-info">
                    Documentos Administrativos
                  </span>
                </div>
                <div class="col-md-12">
                @forelse ($trabajador->documentos_personales as $doc_personal  )
                    @if ($doc_personal->tipo_documento=='administrativo')
                        <i class="fas fa-file-pdf bg-danger"></i>
                        <div class="timeline-item">
                            {{-- <span class="time"><i class="far fa-clock"></i> 12:05</span> --}}
                            <h3 class="timeline-header">
                                <b><a href="#">Documento</a> :{{$doc_personal->detalle_documento}} </b>
                            </h3>
                            <div class="timeline-body">
                                <b>Fecha de registro:</b>{{$doc_personal->fecha_registro->format('d/m/Y')}} <br>
                            </div>
                            <div class="timeline-footer">
                                @if (($doc_personal->file_documento)!="")
                                    <button type="button" class='btn btn-primary btn-icon btn-xs' data-id="{{encrypt($doc_personal->id)}}" id="ViewModalDocumentoPersonal">
                                        Ver Documento Administrativo <i class="fas fa-file-pdf"></i>
                                    </button>
                                @else
                                    <p>Sin Documento</p>
                                @endif
                            </div>

                        </div><br>
                    @endif
                  @empty
                    <p>No hay Documentos registrados.</p>
                @endforelse
                </div>
                <div>
                  <i class="far fa-clock bg-gray"></i>
                </div>
              </div>
        </div>
    </div>
</div>
