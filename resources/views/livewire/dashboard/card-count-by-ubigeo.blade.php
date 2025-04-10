<div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <div>Departamentos</div>
            <select wire:model.live="departamento" class="border border-gray-300 rounded-md p-2 w-full">
                <option value="">Seleccionar</option>
                @foreach ($departamentos as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <div>Provincias</div>
            <select wire:model.live="provincia" class="border border-gray-300 rounded-md p-2 w-full">
                <option value="">Seleccionar</option>
                @foreach ($provincias as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="overscroll-x-auto">
        <table class="text-left table-auto min-w-max mt-5">
            <thead>
            <tr>
                <th class="py-4 pe-4 border-b border-slate-200">Departamentos</th>
                @if(count($data_provincias)>0)
                    <th class="py-4 pe-4 border-b border-slate-200">Provincias</th>
                @endif
                @if(count($data_distritos)>0)
                    <th class="py-4 pe-4 border-b border-slate-200">Distritos</th>
                @endif
                <th class="py-4 pe-4 border-b border-slate-200">Adheridos</th>
                <th class="py-4 pe-4 border-b border-slate-200">Firmas</th>
            </tr>
            </thead>
            <tbody>
            @if(count($data_provincias)==0)
                @foreach ($data as $item)
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="">{{ $item->departamento }}</td>
                        <td class="text-center">{{ $item->cnt }}</td>
                        <td class="text-center">{{ $item->cnt_signature }}</td>
                    </tr>
                @endforeach
            @elseif(count($data_provincias)>0 && count($data_distritos)==0)
                @foreach($data_provincias as $p)
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="">{{ $p->departamento }}</td>
                        <td class="">{{ $p->provincia }}</td>
                        <td class="text-center">{{ $p->cnt }}</td>
                        <td class="text-center">{{ $p->cnt_signature }}</td>
                    </tr>
                @endforeach
            @elseif(count($data_distritos)>0)
                @foreach($data_distritos as $d)
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="">{{ $d->departamento }}</td>
                        <td class="">{{ $d->provincia }}</td>
                        <td class="">{{ $d->distrito }}</td>
                        <td class="text-center">{{ $d->cnt }}</td>
                        <td class="text-center">{{ $d->cnt_signature }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td class="py-4 pe-4 border-b border-slate-200">Total</td>
                @if(count($data_provincias)>0)
                    <td class="py-4 pe-4 border-b border-slate-200"></td>
                @endif
                @if(count($data_distritos)>0)
                    <td class="py-4 pe-4 border-b border-slate-200"></td>
                @endif
                <td class="py-4 pe-4 border-b border-slate-200 text-center">
                    @if(count($data_provincias)==0)
                        {{ $total_data }}
                    @elseif(count($data_provincias)>0 && count($data_distritos)==0)
                        {{ $total_provincia }}
                    @elseif(count($data_distritos)>0)
                        {{ $total_distrito }}
                    @endif
                </td>
                <td class="border-b border-slate-200 text-center">
                    @if(count($data_provincias)==0)
                        {{ $total_data_s }}
                    @elseif(count($data_provincias)>0 && count($data_distritos)==0)
                        {{ $total_provincia_s }}
                    @elseif(count($data_distritos)>0)
                        {{ $total_distrito_s }}
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>

    </div>

</div>
