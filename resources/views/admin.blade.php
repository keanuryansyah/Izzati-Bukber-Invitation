<head><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-6">Daftar Kehadiran Bukber</h1>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Alasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr class="border-b">
                    <td class="p-3">{{ $row->name }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs {{ $row->status == 'hadir' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ strtoupper($row->status) }}
                        </span>
                    </td>
                    <td class="p-3 text-sm text-gray-500">{{ $row->reason ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>