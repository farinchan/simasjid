<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use App\Models\FinanceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Keuangan',
            'breadcrumbs' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('back.dashboard')
                ],
                [
                    'name' => 'Keuangan',
                    'link' => route('back.finance.index')
                ]
            ],
            'categories' => FinanceCategory::all(),
        ];
        // return response()->json($data);
        return view('back.finance.index', $data);
    }

    public function datatables(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $date_end = $request->date_end ?? now()->toDateString();
        $date_start = $request->date_start ?? now()->subMonth()->toDateString();

        $data = Finance::with('createdBy', 'updatedBy')

            ->whereBetween('date', [$date_start, $date_end])
            ->get();

        $total_income = $data->where('type', 'income')->sum('amount');
        $total_expense = $data->where('type', 'expense')->sum('amount');
        $total_balance = $total_income - $total_expense;

        return datatables()->of($data)
            ->addColumn('transaction', function ($row) {
                return '<div class="d-flex flex-column">
                            <a href="#"
                            class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</a>
                            <span class="text-muted">' . Str::limit($row->description, 50) . '</span>
                        </div>';
            })
            ->addColumn('date', function ($row) {
                return '<span class="fw-bold">' . Carbon::parse($row->date)->format('d M Y') . '</span>';
            })
            ->addColumn('amount', function ($row) {
                if ($row->type == 'income') {
                    return '<span class="text-success">+' . number_format($row->amount, 0, ',', '.') . '</span>';
                } else {
                    return '<span class="text-danger">-' . number_format($row->amount, 0, ',', '.') . '</span>';
                }
            })
            ->addColumn('type', function ($row) {
                return '<span class="badge badge-' . ($row->type == 'income' ? 'success' : 'danger') . '">' . $row->type . '</span>';
            })
            ->addColumn('payment_info', function ($row) {
                return '<ul>
                            <li>
                                <span class="fw-bold">Metode Pembayaran:</span>
                                <span>' . ($row->payment_method ?? '-') . '</span>
                            </li>
                            <li>
                                <span class="fw-bold">No Ref:</span>
                                <span>' . ($row->payment_reference ?? '-') . '</span>
                            </li>
                            <li>
                                <span class="fw-bold">Note:</span>
                                <span>' . ($row->payment_note ?? '-') . '</span>
                            </li>
                        </ul>';
            })
            ->addColumn('attachment', function ($row) {
                if ($row->attachment) {
                    return '<a href="' . asset('storage/' . $row->attachment) . '" target="_blank">
                        <i class="ki-duotone ki-file-added text-primary fs-3x" data-bs-toggle="tooltip" data-bs-placement="right" title="Lihat File">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>';
                } else {
                    return '<i class="ki-duotone ki-file-deleted text-danger fs-3x" data-bs-toggle="tooltip" data-bs-placement="right" title="File Tidak Ada">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>';
                }
            })
            ->addColumn('log', function ($row) {
                return '<ul>
                    <li>
                        <span class="fw-bold">Created At:</span>
                        <span>' . Carbon::parse($row->created_at)->format('d M Y H:i') . '</span>
                    </li>

                    <li>
                        <span class="fw-bold">Created By:</span>
                        <span>' . $row->createdBy->name . '</span>
                    </li>
                </ul>

                <ul>
                    <li>
                        <span class="fw-bold">Updated At:</span>
                        <span>' . Carbon::parse($row->updated_at)->format('d M Y H:i') . '</span>
                    </li>

                    <li>
                        <span class="fw-bold">Updated By:</span>
                        <span>' . $row->updatedBy->name . '</span>
                    </li>
                </ul>';
            })
            ->with([
                'total_income' => $total_income,
                'total_expense' => $total_expense,
                'total_balance' => $total_balance,
            ])
            ->rawColumns(['transaction', 'date', 'amount', 'type', 'payment_info', 'attachment', 'log'])
            ->make(true);
    }

     public function store(Request $request, $id)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'amount' => 'required',
            'type' => 'required',
            'date' => 'required',
            'payment_method' => 'nullable',
            'payment_reference' => 'nullable',
            'payment_note' => 'nullable',
            'attachment' => 'nullable|mimes:jpeg,png,jpg,pdf',
        ], [
            'name.required' => 'Nama wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'amount.required' => 'Jumlah wajib diisi',
            'type.required' => 'Tipe wajib diisi',
            'date.required' => 'Tanggal wajib diisi',
            'date.date' => 'Tanggal harus berupa tanggal',
            'payment_method.required' => 'Metode pembayaran wajib diisi',
            'payment_reference.required' => 'Referensi pembayaran wajib diisi',
            'payment_note.required' => 'Catatan pembayaran wajib diisi',
            'attachment.required' => 'Bukti pembayaran wajib diisi',
            'attachment.mimes' => 'Bukti pembayaran harus berformat jpeg, png, jpg, pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', implode(', ', $validator->errors()->all()));
        }

        // $umrah_schedule = UmrahSchedule::find($id);
        $umrah_finance = new UmrahFinance();
        $umrah_finance->umrah_schedule_id = $id;
        $umrah_finance->name = $request->name;
        $umrah_finance->description = $request->description;
        $umrah_finance->amount = $request->amount;
        $umrah_finance->type = $request->type;
        $umrah_finance->date = $request->date;
        $umrah_finance->payment_method = $request->payment_method;
        $umrah_finance->payment_reference = $request->payment_reference;
        $umrah_finance->payment_note = $request->payment_note;
        $umrah_finance->created_by = Auth::user()->id;
        $umrah_finance->updated_by = Auth::user()->id;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachment_name = 'attachment-' . Str::slug($umrah_finance->name, '-') . '-' . time() . '.' . $attachment->getClientOriginalExtension();
            $umrah_finance->attachment = $attachment->storeAs('umrah/finance', $attachment_name, 'public');
        }

        $umrah_finance->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id, $finance_id)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'amount' => 'required',
            'type' => 'required',
            'date' => 'required',
            'payment_method' => 'nullable',
            'payment_reference' => 'nullable',
            'payment_note' => 'nullable',
            'attachment' => 'nullable|mimes:jpeg,png,jpg,pdf',
        ], [
            'name.required' => 'Nama wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'amount.required' => 'Jumlah wajib diisi',
            'type.required' => 'Tipe wajib diisi',
            'date.required' => 'Tanggal wajib diisi',
            'date.date' => 'Tanggal harus berupa tanggal',
            'payment_method.required' => 'Metode pembayaran wajib diisi',
            'payment_reference.required' => 'Referensi pembayaran wajib diisi',
            'payment_note.required' => 'Catatan pembayaran wajib diisi',
            'attachment.required' => 'Bukti pembayaran wajib diisi',
            'attachment.mimes' => 'Bukti pembayaran harus berformat jpeg, png, jpg, pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', implode(', ', $validator->errors()->all()));
        }

        // $umrah_schedule = UmrahSchedule::find($id);
        $umrah_finance = UmrahFinance::find($finance_id);
        $umrah_finance->name = $request->name;
        $umrah_finance->description = $request->description;
        $umrah_finance->amount = $request->amount;
        $umrah_finance->type = $request->type;
        $umrah_finance->date = $request->date;
        $umrah_finance->payment_method = $request->payment_method;
        $umrah_finance->payment_reference = $request->payment_reference;
        $umrah_finance->payment_note = $request->payment_note;
        $umrah_finance->updated_by = Auth::user()->id;

        if ($request->hasFile('attachment')) {
            if ($umrah_finance->attachment) {
                Storage::delete('public/' . $umrah_finance->attachment);
            }
            $attachment = $request->file('attachment');
            $attachment_name = 'attachment-' . Str::slug($umrah_finance->name, '-') . '-' . time() . '.' . $attachment->getClientOriginalExtension();
            $umrah_finance->attachment = $attachment->storeAs('umrah/finance', $attachment_name, 'public');
        }

        $umrah_finance->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function delete($id, $finance_id)
    {
        $umrah_finance = UmrahFinance::find($finance_id);
        if ($umrah_finance->attachment) {
            Storage::delete('public/' . $umrah_finance->attachment);
        }
        $umrah_finance->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // public function UmrahFinanceExport(Request $request)
    // {
    //     $schedule_id = $request->schedule_id;
    //     $date_end = $request->date_end ?? now()->toDateString();
    //     $date_start = $request->date_start ?? now()->subMonth()->toDateString();

    //     return Excel::download(new UmrahFinanceExport($schedule_id, $date_start, $date_end), 'laporan-keuangan-umrah.xlsx');
    // }
}
