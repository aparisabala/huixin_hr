<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.document.fileds.lib_document_id')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.document.fileds.doc')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['item']?->document ?? [] as $index => $docu)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $docu?->libDoc?->name }}</td>
                <td>
                    @if($docu->doc != null)
                        @php
                            $path = url(imagePaths()['dyn_image'].$docu?->doc);
                        @endphp
                        <a href="{{$path}}" download=""> Dowload Uploded document </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
