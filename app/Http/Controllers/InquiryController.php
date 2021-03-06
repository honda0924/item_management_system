<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryMail;

class InquiryController extends Controller
{
    private $inquiryElements = ["inquirer_name", "email", "tel", "gender", "hobby", "skill", "inquiry_text"];

    public function index()
    {
        return view('inquiry/index');
    }

    public function confirm(InquiryRequest $request)
    {
        $input = $request->only($this->inquiryElements);
        $request->session()->put("inquiry_input", $input);

        if (!$input) {
            return view('inquiry/confirm');
        }

        return view('inquiry/confirm', compact('input'));
    }
    public function send(Request $request)
    {
        $input = $request->session()->get('inquiry_input');

        if ($request->has('back')) {
            return redirect('inquiry')
                ->withInput($input);
        }

        if (!$input) {
            return redirect('inquiry');
        }
        Mail::to($input["email"])->cc(config('mail.from.address'))->send(new InquiryMail($input));
        if ($input["gender"] == '男性') {
            $gender = 0;
        } elseif ($input["gender"] == '女性') {
            $gender = 1;
        }

        DB::table('inquiries')->insert(
            [
                'inquirer_name' => $input["inquirer_name"],
                'email' => $input["email"],
                'tel' => $input["tel"],
                'gender' => $gender,
                'hobby' => $input["hobby"],
                'skill' => $input["skill"],
                'inquiry_text' => $input["inquiry_text"],
                'created_at' => now(),
            ]
        );




        $request->session()->forget('inquiry_input');
        return redirect('inquiry/complete');
    }
    public function complete()
    {
        return view('inquiry/complete');
    }
    public function csv()
    {
        return view('inquiry/csv');
    }
    public function download(Request $request)
    {
        $headers = [ //ヘッダー情報
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=inquiryexport.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($request) {
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'inquirer_name',
                'email',
                'tel',
                'gender',
                'hobby',
                'skill',
                'inquiry_text',
                'created_at',
            ];

            // mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $validator = [
                "inquiry_year" => "required|integer",
                "inquiry_month" => "required|integer",

            ];

            $request->validate($validator);
            $inquiries = DB::table('inquiries')
                ->whereYear('created_at', '=', $request["inquiry_year"])
                ->whereMonth('created_at', '=', $request["inquiry_month"])
                ->get();
            foreach ($inquiries as $row) {
                $csv = [
                    $row->inquirer_name,
                    $row->email,
                    $row->tel,
                    $row->gender == 0 ? '男性' : '女性',
                    $row->hobby,
                    $row->skill,
                    $row->inquiry_text,
                    $row->created_at,
                ];
                // mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };

        return response()->stream($callback, 200, $headers);
    }
}
