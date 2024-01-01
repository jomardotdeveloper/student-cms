<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Sentiment\Analyzer;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        $csv_file = Setting::first()->csv_file;
        if ($csv_file == null) {
            $columns = [];
            $bodies = [];
            return view('import.index', compact('csv_file', 'columns', 'bodies'));
        }
        $csv = $this->readCSV(public_path($csv_file));
        $columns = $this->getCsvColumns($csv);
        $bodies = $this->getCsvBody($csv);
        return view('import.index' , compact('csv_file' , 'columns' , 'bodies'));
    }

    public function uploadCsv(Request $request) {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $path = $this->upload($file, 'csv_files');

        $setting = Setting::first();
        $setting->csv_file = $path;
        $setting->save();



        return redirect()->route('imports.index')->with('success', 'CSV file uploaded successfully');
    }

    public function getValueCount($column, $current_value) {
        $csv_file = Setting::first()->csv_file;
        $csv = $this->readCSV(public_path($csv_file));
        $column_index = 0;

        foreach ($csv as $key => $value) {
            if ($key == 0) {
                foreach ($value as $k => $v) {
                    if ($v == $column) {
                        $column_index = $k;
                    }
                }
            }
        }

        $count = 0;


        foreach ($csv as $key => $value) {
            if ($key != 0) {
                foreach ($value as $k => $v) {
                    if ($k == $column_index) {
                        // dd($v, $value);
                        foreach($value as $zxc){
                            // dd($zxc, $value);
                            // dd();
                            if ($zxc == $current_value) {
                                $count++;
                            }
                        }

                    }
                }
            }
        }
        // dd($count);
        return $count;
    }

    public function getSimilarValues($column) {
        $csv_file = Setting::first()->csv_file;
        $csv = $this->readCSV(public_path($csv_file));
        $column_index = 0;

        foreach ($csv as $key => $value) {
            if ($key == 0) {
                foreach ($value as $k => $v) {
                    if ($v == $column) {
                        $column_index = $k;
                    }
                }
            }
        }

        $values = [];

        foreach ($csv as $key => $value) {
            if ($key != 0) {
                foreach ($value as $k => $v) {
                    if ($k == $column_index) {
                        if(!in_array($v, $values))
                            $values[] = $v;
                    }
                }
            }
        }

        $values = array_unique($values);
        return $values;
    }

    public function getCsvBody($csv_file) {
        $bodies = [];


        foreach ($csv_file as $key => $value) {
            if ($key != 0) {
                foreach ($value as $k => $v) {
                    $bodies[$key][$k] = $v;
                }
            }
        }

        return $bodies;
    }

    public function getCsvColumns($csv_file) {
        $columns = [];

        foreach ($csv_file as $key => $value) {
            if ($key == 0) {
                foreach ($value as $k => $v) {
                    $columns[$k] = $v;
                }
            }
        }

        return $columns;
    }

    public function readCSV($csvFile, $delimiter = ',')
    {
        $file_handle = fopen($csvFile, 'r');
        while ($csvRow = fgetcsv($file_handle, null, $delimiter)) {
            $line_of_text[] = $csvRow;
        }
        fclose($file_handle);
        return $line_of_text;
    }



    public function chart(Request $request)
    {
        $y = [];
        $x = [];
        $chart_type = $request->chart_type;
        $is_sentiment = $request->is_sentiment;
        $title = $request->title;

        if ($is_sentiment) {
            $data_type = $request->data_type;
            $column = $request->column;
            $x = ["positive", "negative", "neutral"];

            if($data_type == "count") {
                $y = $this->getSentimentData($column);
            } else {
                $y = $this->getSentimentValueData($column);
            }

        } else {
            $column = $request->column;
            $x = $request->data_to_include;

            foreach ($x as $key => $value) {
                $y[] = $this->getValueCount($column, $value);
            }
        }

        return view('import.chart' , compact('chart_type' , 'x', 'y' , 'title'));
    }

    public function getSentimentValueData($column) {
        $csv_file = Setting::first()->csv_file;
        $csv = $this->readCSV(public_path($csv_file));
        $column_index = 0;

        foreach ($csv as $key => $value) {
            if ($key == 0) {
                foreach ($value as $k => $v) {
                    if ($v == $column) {
                        $column_index = $k;
                    }
                }
            }
        }


        $sentiments = [
            'positive' => 0,
            'negative' => 0,
            'neutral' => 0,
        ];


        foreach ($csv as $key => $value) {
            if ($key != 0) {
                foreach ($value as $k => $v) {
                    if ($k == $column_index) {
                        $sentiment = $this->getSentimentValue($v);
                        if ($sentiment['mood'] == 'Positive') {
                            $sentiments['positive'] += $sentiment['value'];
                        }

                        if ($sentiment['mood'] == 'Negative') {
                            $sentiments['negative'] += $sentiment['value'];
                        }

                        if ($sentiment['mood'] == 'Neutral') {
                            $sentiments['neutral'] += $sentiment['value'];
                        }
                    }
                }
            }
        }


        $sentiments = array_values($sentiments);


        return $sentiments;
    }

    public function getSentimentData($column) {
        $csv_file = Setting::first()->csv_file;
        $csv = $this->readCSV(public_path($csv_file));
        $column_index = 0;

        foreach ($csv as $key => $value) {
            if ($key == 0) {
                foreach ($value as $k => $v) {
                    if ($v == $column) {
                        $column_index = $k;
                    }
                }
            }
        }


        $sentiments = [
            'positive' => 0,
            'negative' => 0,
            'neutral' => 0,
        ];


        foreach ($csv as $key => $value) {
            if ($key != 0) {
                foreach ($value as $k => $v) {
                    if ($k == $column_index) {
                        $sentiment = $this->getSentiment($v);
                        if ($sentiment == 'Positive') {
                            $sentiments['positive'] += 1;
                        }

                        if ($sentiment == 'Negative') {
                            $sentiments['negative'] += 1;
                        }

                        if ($sentiment == 'Neutral') {
                            $sentiments['neutral'] += 1;
                        }
                    }
                }
            }
        }


        $sentiments = array_values($sentiments);


        return $sentiments;



    }

    public function getSentimentValue ($text) {
        $analyzer = new Analyzer();
        $output_text = $analyzer->getSentiment($text);
        $mood = '';
        $max = 0;

        foreach ($output_text as $key => $value) {
            if ($value > $max) {
                $max = $value;

                if ($key == 'pos') {
                    $mood = 'Positive';
                } elseif ($key == 'neg') {
                    $mood = 'Negative';
                } else {
                    $mood = 'Neutral';
                }

            }
        }
        return [
            'mood' => $mood,
            'value' => $max
        ];
    }

    public function getSentiment($text) {
        $analyzer = new Analyzer();
        $output_text = $analyzer->getSentiment($text);
        $mood = '';
        $max = 0;

        foreach ($output_text as $key => $value) {
            if ($value > $max) {
                $max = $value;

                if ($key == 'pos') {
                    $mood = 'Positive';
                } elseif ($key == 'neg') {
                    $mood = 'Negative';
                } else {
                    $mood = 'Neutral';
                }

            }
        }


        return $mood;

    }

}
