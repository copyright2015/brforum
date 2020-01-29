<?php

namespace App\Widgets;

use App\Report;
use Arrilot\Widgets\AbstractWidget;
use ACL;

class NewReports extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    protected $reports;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        if(ACL::isAdmin() || ACL::isGlobal_mod()){
            $this->reports = Report::where('is_readed', false)->get();
            foreach ($this->reports as $report){
                $report->load('post');
            }
        }

        return view('widgets.new_reports', [
            'config' => $this->config,
            'reports' => $this->reports,
        ]);
    }
}
