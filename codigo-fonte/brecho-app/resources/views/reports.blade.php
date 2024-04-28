<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brechó</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="font-sans antialiased bg-gray-100 h-screen">
    <x-navbar />

    <section class="mt-5" id='content'>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">

            <!-- Download PDF -->

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Relatório de Compras e Vendas
                    </h1>

                    <!-- Pedidos -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Id</th>
                                    <!-- Add more table headers if needed -->
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Data</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Endereço</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Número da Rua</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Complemento do Endereço</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Bairro</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        CEP</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Cidade</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Estado</th>
                                    <th
                                        class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Total do Pedido</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($orders as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->user_id }}</td>
                                        <!-- Add more table cells for other data -->
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->status }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->date }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->address }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->number }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->complement }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->district }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->cep }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->city }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->state }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->total }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->track }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <br />
    <br />
    <br />
    <br />
    
     <!-- Chart component -->
     <canvas id="myChart"></canvas>

    <button id="download-pdf">Download PDF</button>

    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            // Get the entire document as the element to be converted to PDF
            var element = document.documentElement; // Entire document

            // Options for the PDF generation
            var opt = {
                margin: 1,
                filename: 'report.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            // Convert the element to PDF
            html2pdf().set(opt).from(element).save();
        });
    </script>


    <script>
        var dataFromBlade = {!! json_encode($orders) !!};
        // console.log(dataFromBlade[0]['total'])

        // Sample data for the chart
        var data = {
            labels: [dataFromBlade[0]['date'], dataFromBlade[1]['date'], dataFromBlade[2]['date'], dataFromBlade[3][
                'date'
            ], dataFromBlade[4]['date']],
            datasets: [{
                label: 'Valor Total x Data',
                data: [dataFromBlade[0]['total'], dataFromBlade[1]['total'], dataFromBlade[2]['total'],
                    dataFromBlade[3]['total'], dataFromBlade[4]['total']
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Configuration for the chart
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('myChart').getContext('2d');

        // Create the chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>

</body>

</html>
