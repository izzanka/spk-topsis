<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifCriteria;
use App\Models\Criteria;
use Illuminate\Support\Str;

class CalculationController extends Controller
{
    public array $alternatif = [];
    public array $kriteria = [];
    public array $alternatif_kriteria = [];
    public array $pembagi = [];
    public array $normalisasi = [];
    public array $bobot = [];
    public array $normxbobot = [];
    public array $cmin = [];
    public array $cmax = [];
    public array $atribut = [];
    public array $ymin = [];
    public array $ymax = [];
    public array $dplusmin = [];

    public function index()
    {
        $alternatif_criterias = AlternatifCriteria::get();
        $criterias = Criteria::select(['name', 'weight', 'attribute'])->get();
        $alternatifs = Alternatif::get();

        foreach($criterias as $criteria)
        {
            $criteria_name = Str::slug(strtolower($criteria->name), '_');

            if($alternatif_criterias->contains($criteria_name, 0)){
               return back()->with('message',['text' => 'Harap masukkan semua data nilai alternatif.', 'class' => 'warning']);
            }
        }

        $alternatif_values = [];

        foreach($alternatifs as $index => $alternatif)
        {
            array_push($alternatif_values, [$alternatif->code, $alternatif->name]);
        }

        foreach($alternatif_criterias as $ac)
        {
            foreach($alternatif_values as $index => $value)
            {
                if($ac->alternatif->code == $value[0])
                {

                    foreach($criterias as $criteria)
                    {
                        $criteria_name = Str::slug(strtolower($criteria->name), '_');
                        array_push($alternatif_values[$index], $ac[$criteria_name]);
                    }
                }
            }
        }

        $this->alternatif = $alternatifs->toArray();
        $this->kriteria = $criterias->toArray();
        $this->alternatif_kriteria = $alternatif_values;

        $this->pembagi();
        $this->normalisasi();
        $this->bobot();
        $this->normxbobot();
        $this->cmax();
        $this->cmin();
        $this->atribut();
        $this->ymaxmin();
        $this->dplusmin();

        $alternatif = $this->alternatif;
        $kriteria = $this->kriteria;
        $alternatif_kriteria = $this->alternatif_kriteria;
        $pembagi = $this->pembagi;
        $normalisasi = $this->normalisasi;
        $bobot = $this->bobot;
        $normxbobot = $this->normxbobot;
        $cmin = $this->cmin;
        $cmax = $this->cmax;
        $atribut = $this->atribut;
        $ymin = $this->ymin;
        $ymax = $this->ymax;
        $dplusmin = $this->dplusmin;

        return view('calculation.index', compact('alternatif', 'kriteria', 'alternatif_kriteria', 'pembagi', 'normalisasi', 'bobot', 'normxbobot', 'cmin', 'cmax', 'atribut', 'ymin', 'ymax', 'dplusmin'));
    }

    public function pembagi()
    {
        foreach($this->kriteria as $k)
        {
            array_push($this->pembagi, 0);
        }

        foreach ($this->alternatif_kriteria as $a)
        {
            for ($i = 0; $i < count($this->kriteria); $i++)
            {
                $this->pembagi[$i] += pow($a[$i + 2], 2);
            }
        }

        for ($i = 0; $i < count($this->pembagi); $i++)
        {
            $this->pembagi[$i] = round(sqrt($this->pembagi[$i]), 3);
        }
    }

    public function normalisasi()
    {
        foreach($this->alternatif_kriteria as $a)
        {
            for($i = 0; $i < count($this->pembagi); $i++)
            {
                $a[$i + 2] = $a[$i + 2] / $this->pembagi[$i];
                $a[$i + 2] = round($a[$i + 2], 3);
            }

            array_push($this->normalisasi, $a);
        }
    }

    public function bobot()
    {
        foreach($this->kriteria as $k)
        {
            array_push($this->bobot, $k['weight']);
        }
    }

    public function normxbobot()
    {
        foreach($this->normalisasi as $n)
        {
            for ($i = 0; $i < count($this->bobot); $i++)
            {
                $n[$i + 2] = $n[$i + 2] * $this->bobot[$i];
            }

            array_push($this->normxbobot, $n);
        }
    }

    public function cmax()
    {
        foreach($this->kriteria as $k)
        {
            array_push($this->cmax, 0);
        }

        foreach ($this->normxbobot as $index => $nb)
        {
            for ($i=0; $i < count($this->kriteria) ; $i++) {
                if ($this->cmax[$i] < $nb[$i+2]) $this->cmax[$i] = $nb[$i+2];
            }

        }
    }

    public function cmin()
    {
        foreach($this->kriteria as $k)
        {
            array_push($this->cmin, 10);
        }

        foreach ($this->normxbobot as $index => $nb)
        {
            for ($i=0; $i < count($this->kriteria); $i++) {
                if ($this->cmin[$i] > $nb[$i+2]) $this->cmin[$i] = $nb[$i+2];
            }
        }
    }

    public function atribut()
    {
        foreach ($this->kriteria as $k)
        {
            array_push($this->atribut, $k['attribute']);
        }
    }

    public function ymaxmin()
    {
        for($i = 0; $i < count($this->atribut); $i++)
        {
            if ($this->atribut[$i] == 'Profit')
            {
                array_push($this->ymax, $this->cmax[$i]);
                array_push($this->ymin, $this->cmin[$i]);
            }

            else if ($this->atribut[$i] == 'Cost')
            {
                array_push($this->ymax, $this->cmin[$i]);
                array_push($this->ymin, $this->cmax[$i]);
            }
        }
    }

    public function dplusmin()
    {
        foreach ($this->normxbobot as $nb)
        {
            $dplus = 0;
            $dmin = 0;

            for ($i = 0; $i < count($this->ymax); $i++)
            {
                $dplus += pow($this->ymax[$i] - $nb[$i + 2], 2);
                $dmin += pow($nb[$i + 2] - $this->ymin[$i], 2);
            }

            $total_array = count($nb);

            $nb[$total_array] = round(sqrt($dplus), 3);
            $nb[$total_array + 1] = round(sqrt($dmin), 3);

            array_push($this->dplusmin, $nb);
        }
    }
}
