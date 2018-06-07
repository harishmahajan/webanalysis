<?php
/**
 * Created by Indrek Päri
 * Date: 3.04.14 13:58
 */

namespace Utility;

class Phantom_chart
{
    public $aVar = array();
    private $aData = array();

    function __construct($aWidth=300,$aHeight=200,$aLabels=array()){
        $this->aData['width'] = $aWidth;
        $this->aData['height'] = $aHeight;
        //$this->aData['options']['fontSize'] = '12';
        $this->aData['options']['fontName'] = 'Verdana';

        $this->aData['data'][0][] = 'Label';
        foreach($aLabels as $k => $label)
        {
            $this->aData['data'][($k+1)][] = $label;
        }
    }

    public function addBar($aData,$sLabel,$sColor,$sOpacity)
    {
        $this->aVar['color'] = $sColor;
        $this->aVar['opacity'] = $sOpacity;

        $this->aData['data'][0][] = $sLabel;
        foreach($aData as $k => $value)
        {
            $this->aData['data'][($k+1)][] = $value;
        }
    }

    public function addLinear($aData,$sLabel,$sColor)
    {
        $this->aData['data'][0][] = $sLabel;
        foreach($aData as $k => $value)
        {
            $this->aData['data'][($k+1)][] = (int)$value;
        }

        $this->aData['options']['colors'][] = $sColor;
    }

    private function postData($sChartType)
    {
        foreach($this->aData['data'] as $k => $value)
        {
            if($sChartType == 'BarChart')
            {
                if($k == 0) $this->aData['data'][$k][] = array('role'=>'style');
                else $this->aData['data'][$k][] = 'color: '.$this->aVar['color'].'; opacity: '.$this->aVar['opacity'];
            }
        }
    }

    private function isPieChart(){
        $this->aData['options']['legend'] = array('position' => 'right');
        $this->aData['options']['chartArea'] = array('left'=>10,'top'=>10,'width'=>'90%','height'=>'80%');
        $this->aData['options']['is3D'] = true;
    }
    private function isLineChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>60,'top'=>10,'width'=>'90%','height'=>'80%');
        $this->aData['options']['vAxis']['minValue'] = "0";
    }
    private function isBarChart(){
        $this->aData['options']['legend']['position'] = 'none';
        $this->aData['options']['chartArea'] = array('left'=>100,'top'=>10,'width'=>'75%','height'=>'85%');
        $this->aData['options']['bar'] = array('groupWidth'=>'30%');
    }
    private function isAreaChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>50,'top'=>10,'width'=>'85%','height'=>'75%');
        $this->aData['options']['pointSize'] = 7;
    }
    private function isComboChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>70,'top'=>10,'width'=>'75%','height'=>'75%');
        $this->aData['options']['seriesType'] = "line";   
        $this->aData['options']['vAxis']['minValue'] = "0";
    }
    private function isColumnChart(){
        $this->aData['options']['legend']['position'] = 'bottom';
        $this->aData['options']['chartArea'] = array('left'=>50,'top'=>10,'width'=>'85%','height'=>'75%');
    }

    public function show($sChartType,$sReturnType='img',$options = array())
    {
        $this->postData($sChartType);

        $m = 'is'.$sChartType;
        if(method_exists($this,$m))
        {
            $this->$m();
        }

        $this->aData['options'] = array_merge($this->aData['options'],$options);

        //$debug = true;
        if($sReturnType == 'img')
        {            
            //old code
            // Display the graph
            exec('sudo phantomjs /var/www/library/phantom_chart/chart.js \''.$sChartType.'\' '.$this->aData['width'].' '.$this->aData['height'].' \''.json_encode($this->aData['options']).'\' \''.json_encode($this->aData['data']).'\' '.(isset($debug)?'1':''),$out);
            return '<img src="data:image/png;base64,'.$out[0].'" />';

            //return '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAf8AAADICAYAAADm+egfAAAcrUlEQVR4nO3de1TUdf7H8S/aVl6w3LWs9mzu1mm3iyc3UHepbdV0yYI86yVdJGyAoFBXMfQo1km85dYebEPtssqmooK2XiZc1Mxy0tKMg2koVl5Ww0sqQSoXBXn9/ujwXcYY5PtLnPH7fT7Oef/BF/zy+X5mmucMjGkIAAA4iuHvBQAAgMuL+AMA4DDEHwAAhyH+AAA4DPEHAMBhiD8AAA5D/AEAcBjiDwCAwxB/AAAchvgDAOAwxB8AAIch/gAAOAzxv0LU1tb6ewmOwV4DsDvi30SffvqpDMMwp23bturXr5+OHDnSbN8rNzdXVVVVGjt2rBYtWnTJzh8XF6d27dopNDS0we9rGIaCgoLUunVr9enTR8ePH//R37P+NTWnLVu2mNeQl5cnSdq/f795bO7cuT7/bFP3+sdcS3Psw2effab27dvr/Pnzl+R8w4cP17XXXqsTJ05I+v7J0MSJE9WuXTvddNNNmjlz5iX5PgD8h/g3Ud2DdmxsrDIzMzV+/Hi1atVKv//97y/59/rmm2/0yiuvaP/+/frqq69kGIbeeuutS3Lu6upqGYahoUOHavv27V6fu/AaR48eLcMwlJCQ8KO/b/1rak518W/RooVSUlIkSXPnzlWLFi0uGv+m7vWPCXhz7MOrr76qfv36XZJzlZSUqHXr1rr66qs1depUSdI777wjwzCUnp6u+Ph4GYahHTt2XJLvB8A/iH8T1T3g14/H5MmTZRiGCgoKJElTp05Vx44ddeONNyo5OVk1NTVmjFJSUnTrrbeqY8eOysrKkiSdPHlSffv2Vdu2bXX99dfrqaeeUnV1tVdc7rnnHvNV6+uvv64+ffrojjvuMNfQrVs39ejR4wfrXbp0qX7961+rTZs26tmzpwoLCyVJnTp1Ms8XHx9/0Wv81a9+pa5du2rNmjUyDEODBw9WcHCwNm7c2OD1StK8efP0y1/+Uq1bt1ZERIRKSkp+EExf6/vggw9kGIbWr18vSRo9erTatGnT6H7VV7ff9913n7p06SJJioqKUkhIiNe1NbT2C/f63LlzcrlcateunVq1aqVHHnlEZWVlXtfSlDU1tMe5ubmN3jcuNH36dHXo0EF33323kpKSZBiG+X0GDhyo9PR0n3v/9ttvyzAMJScnq0OHDvrNb36juXPnqnPnzmrbtq2mT59ufp9p06apY8eOev7553XzzTfr3Llzqqys1Oeffy5JmjVrloKCgrR7926f1wgg8BH/JmoojOvWrZNhGFq8eLHcbrdatmyprKws/fvf/1br1q01d+5c8wH+scce05dffqn7779fN998syTppZde0jXXXKOCggItWbJEkZGRKioq8gpE3auuiRMn6ujRo1qyZIn5hOPAgQMyDEOZmZlea/3ss8/UsmVLDRw4UMuXL9e9996rTp06qaKiQlu3bpVhGBo+fLj27dvX4DWmp6fr8OHDWrVqlVq2bKl+/fqZ8Q8PD9eiRYu0fPnyBq9327ZtCgoK0ujRo7V8+XK1bdtW48aN87qmxtbXWPx97Vd9dfs9ZswYBQUF6fjx47rpppv07LPPmrefr9vqwr3+6KOPdOedd2rp0qWaP3++DMPQokWLvK6lKWtqaI/rx7+h+0Z9mzZtkmEYGj16tNatW6dbbrnFK/433HCD8vPzfe59XfyHDx+uXbt2qVWrVrrhhhu0Y8cORUdH6yc/+Ymqq6t19uxZ3XzzzRo3bpwOHjyoFi1aeD0ZGTdunAzDUFJS0kX/ewEQ2Ih/EzUW/4ULF2rEiBEKCgrSddddp+uuu06tWrXSM888Yz7Ar1y5UpI0duxYXXXVVZKktWvXKigoSNdff70GDBig7Oxs1dbWegXiwh9FV1ZWqn379ho/frz+/ve/q3Xr1jp16pTXWl944QUZhqFvv/1WkpSbmyvDMPThhx+qsrJShmFoxowZPq+x/txwww3atWuXGX+32y1JPq/3xRdflGEYKisrkyRVVFR4nTs3N7fR9V0Y/1GjRpnx97Vf9dXt94oVK9SiRQvze7ndbvP287X2hn7s/9lnn2nGjBl69NFHZRiG5syZ43UtTVlTQ3tcP/4N3Tfqmz59ugzDMG/n8ePHm/HfvXu32rVrp5qaGp97Xxf/Tz75RJJ06623atCgQZKk9PR088/s379fkyZN0oEDByRJr7/+urKzs8117Nu3T1lZWTIMw+s4gCsP8W+ihuI/c+ZM80E1MTFRbdq0Md90Vfc73boH+DVr1kj6/oG7ZcuW5jm2bdumsWPH6r777pNhGJo1a1aj8Ze+f0PWbbfdpu7du2vo0KE/WOukSZNkGIZKS0sl/e93tps2bWpS/JOTk7Vu3Tpt3rxZZ86ckSQz/h6PR5J8Xm9dgOreLPbpp59q7969XtfU2Po2btzotV8JCQlm/H3tV311+/3BBx/ot7/9rYKDgxUcHKzi4mLz9vO19gv3+p133lGLFi00YsQIZWdnyzAMvfbaaz/4FcbF1tTQHtePv6/7Rp0pU6Z4PVlKSUkx4//666/r0UcfbXTv6+Jf9x6PTp06KTo6WpL0yiuveN0WDSksLNT8+fPNj4ODg/X000/7/HoAgY/4N1Hdg3Z8fLyysrL04osvqn379uY75pcuXSrDMDR16lTl5OTIMAzNmzev0Qf46dOnq2PHjnr//ff18ccfq2XLlpoyZYpXIA4ePGi+6W7Xrl2SpPz8fPOV+dq1axtca1BQkB5//HGtWLFCXbp00e23367Kysomxb+hN8XVxX/Tpk2NXu8nn3wiwzAUFxenrKwstW/fXnFxcV7X1Nj6CgsLzX1eu3atOnbsaMbf137VVz/+dW9Y7Nu3r44ePWpem6+1X7jXzz77rK6++modPnxYixcvlmEYmj17tte1+FrT3r17lZKSoi+//LLBPbYS/7of+8fFxSknJ0c/+9nPzPhHRUXppZdekiSfe/9j41+3R5MnT9Zzzz0nwzB8vjcBwJWB+DfRhT8SDw4O1p///GcdOnRI0vd/HWrq1Kn6xS9+oXbt2mn48OFeb/hr6AG+pKRE/fv3V3BwsK677joNGTJEp06d8gpEbW2t+vTpo+DgYL3xxhvmem677Tbdcsst5pvsLpSVlaU77rhDrVu3Vq9evbRnzx5JumTx93W9kvTGG2+oU6dOatOmjSIiInTy5MkfvFr2tT7p+9/zX3vtteratauSkpLM+Pvar/rqx3/lypUyDEN/+9vfvOLva+0X7vXu3bt1zz33KDg4WAMHDtRNN92kkSNHel2LrzXV/fpiw4YNDe6xlfhL0owZM9ShQweFhoYqOjpaLVq0UG1trX7+859r69at5tc1tPc/Nv6S9Pzzz6tDhw668cYb9cILLzT6tQACH/G/wuzZs0fz5s1TUFCQUlNT/b0cNGLAgAH66quvfvR5tm7dqsGDBysjI0MfffSRevXqpbvvvvsSrBCAUxH/K8wrr7yia665Rj179lRJSYm/lwMfdu7c2ejv/q2oqKhQdHS0fvrTn+qqq65S586dtXnz5ktybgDORPwBAHAY4g8AgMMQfwAAHIb4AwDgMMQfAACHIf4AADgM8QcAwGGIPwAADkP8AQBwGOIPAIDD2C7+CxcuVGxsrGJjYzV79mzz31ZPTU1VRESEIiMjFRkZqS1btvh5pQAA+Iet4r99+3aNGDFCZ8+eVU1NjSZMmKD33ntPkjRkyBBVVlb6eYUAAPifreJ/6NAhFRUVmR+/+eabWrZsmY4cOaJBgwYpOTlZw4YN06JFi/y4SgAA/MtW8a/v2LFjioqKUnFxsYqKijR58mSdPn1apaWlSkxMlMfj8fcSAQDwC1vG/+uvv5bL5dKmTZsa/Lzb7VZ6erqlc+bn5zMMwzBXwODibBf/oqIiPfHEE153gMLCQq+P3W63MjIy/LE8AAD8zlbxP3r0qIYOHap9+/Z5Hd+2bZsSEhJUVVWliooKJSUlqaCgwE+rBADAv2wV/zlz5ig8PNz863yRkZGaP3++JGnBggVyuVyKiYlRTk6On1cKAID/2Cr+AADg4og/AAAOQ/wBAHAY4g8AgMMQfwAAHIb4AwDgMMQfAACHIf4AADgM8QcAwGGIPwAADkP8AQBwGOIPAIDDEH8AAByG+AMA4DDEHwAAhyH+AAA4DPEHAMBhiD8AAA5D/AHgMqmqrNR335UxzTBVVVX+vnmvKMQfAC6T774r0+HiQ0wzzOlT3/n75r2iEH8AuEyIP/EPFMQfAC4T4k/8AwXxB4DLhPgT/0Bhu/gvXLhQsbGxio2N1ezZs1VbWytJysvLk8vlUkxMjPLy8vy8SgBORPyJf6CwVfy3b9+uESNG6OzZs6qpqdGECRP03nvv6fDhwxo2bJjOnDmj8vJyxcfH6/Dhw/5eLgCHIf7EP1DYKv6HDh1SUVGR+fGbb76pZcuWye12a/bs2ebxzMxM5eTk+GOJAByM+BP/QGGr+Nd37NgxRUVFqbi4WJmZmcrOzjY/t2rVKq8nAwBwORB/4h8obBn/r7/+Wi6XS5s2bZKkBuM/Z84cS+fMz89nGIb5UfPFF3v8Hkm7zp6i3eY+4+JsF/+ioiI98cQTXncAt9vtFfvMzEwtW7bMH8sD4GC88m++4ZW/NbaK/9GjRzV06FDt27fP63jdG/5OnTql8vJyxcXF6cCBA/5ZJADHIv7EP1DYKv5z5sxReHi4IiMjzZk/f74kac2aNYqNjVVMTIxWrFjh55UCcCLiT/wDha3iD+D/4cwa6fh4pjmm/AOvrSb+xD9QEH/A6Y5PkIoMpjnm5AyvrSb+xD9QEH/A6Yg/8bfBEH9riD/gdMSf+NtgiL81xB9wOuJP/G0wxN8a4g84HfEn/jYY4m8N8QecjvgTfxsM8beG+ANOR/yJvw2G+FtD/AGnI/7E3wZD/K0h/oDTEX/ib4Mh/tYQf8DpiD/xt8EQf2uIP+B0xJ/422CIvzXEH3A64k/8bTDE3xriDzgd8Sf+Nhjibw3xB5yO+BN/Gwzxt4b4A05H/Im/DYb4W0P8Aacj/sTfBkP8rSH+gNMRf+JvgyH+1hB/wOmIP/G3wRB/a4g/4HTEn/jbYIi/NcQfcDriT/xtMMTfGuIPOB3xJ/42GOJvDfEHnI74E38bDPG3xpbxLy8vV3x8vEpKSsxjqampioiIUGRkpCIjI7VlyxY/rhAIIMSf+NtgiL81tot/UVGREhIS1LdvX6/4DxkyRJWVlX5cGRCgiD/xt8EQf2tsF/+ZM2dq586dio6ONuN/5MgRDRo0SMnJyRo2bJgWLVrk51UCAYT4E38bDPG3xnbxr1M//kVFRZo8ebJOnz6t0tJSJSYmyuPx+HmFQIAg/sTfBkP8rXFE/C/kdruVnp5u6Xz5+fkMY8s5utPl/0jadIp3jPTa6y++2OP3SNp19hTtNvcZF+eI+BcWFnrdIdxutzIyMvy1NCCw8Mq/+YZX/pdteOVvjSPiv23bNiUkJKiqqkoVFRVKSkpSQUGBn1cIBAjiT/xtMMTfGkfEX5IWLFggl8ulmJgY5eTk+HFlQIAh/sTfBkP8rbFt/AE0EfEn/jYY4m8N8QecjvgTfxsM8beG+ANOR/yJvw2G+FtD/AGnI/7E3wZD/K0h/oDTEX/ib4Mh/tYQf8DpiD/xt8EQf2uIP+B0xJ/422CIvzXEH3A64k/8bTDE3xriDzgd8Sf+Nhjibw3xB5yO+BN/Gwzxt4b4A05H/Im/DYb4W0P8Aacj/sTfBkP8rSH+gNMRf+JvgyH+1hB/wOmIP/G3wRB/a4g/4HTEn/jbYIi/NcQfcDriT/xtMMTfGuIPOB3xJ/42GOJvDfEHnI74E38bDPG3hvgDTkf8ib8NhvhbQ/wBpyP+xN8GQ/ytIf6A0xF/4m+DIf7WEH/A6Yg/8bfBEH9rbBn/8vJyxcfHq6SkxDyWl5cnl8ulmJgY5eXl+XF1QIAh/sTfBkP8rbFd/IuKipSQkKC+ffua8T98+LCGDRumM2fOmE8MDh8+7OeVojElJSXat28f0wxTWlrqvdnEn/jbYIi/NbaL/8yZM7Vz505FR0eb8Xe73Zo9e7b5NZmZmcrJyfHXEtEE+/fv18aNG5lmmIMHD3pvNvEn/jYY4m+N7eJfp378MzMzlZ2dbX5u1apVXk8GEHiIP/G3xRB/4h+gHBv/OXPmWDpffn4+cxnn448/9nsk7Toff/yx114f3enyfyRtOsU7Rnrt9Rdf7PF7JO06e4p2m/uMi3NE/N1ut1fsMzMztWzZMn8tDU3AK//mG175X8bhlf9lG175W+OI+Ne94e/UqVMqLy9XXFycDhw44N8FolHEn/jbYog/8Q9Qjoi/JK1Zs0axsbGKiYnRihUr/LgyNAXxJ/62GOJP/AOUbeOPKxvxJ/62GOJP/AMU8UdAIv7E3xZD/Il/gCL+CEjEn/jbYog/8Q9QxN+CE0Uf6YvVGUwzTMle77+eQ/yJvy2G+BP/AEX8LfjiP7O0NiWUaYbZv+Etr70m/sTfFkP8iX+AIv4WEH/ib4ch/sTfjkP8rSH+FhB/4m+HIf7E345D/K0h/hYQf+JvhyH+xN+OQ/ytIf4WEH/ib4ch/sTfjkP8rSH+FhB/4m+HIf7E345D/K0h/hYQf+JvhyH+xN+OQ/ytIf4WEH/ib4ch/sTfjkP8rSH+FhB/4m+HIf7E345D/K0h/hYQf+JvhyH+xN+OQ/ytIf4WEH/ib4ch/sTfjkP8rSH+FhB/4m+HIf7E345D/K0h/hYQf+JvhyH+xN+OQ/ytIf4WEH/ib4ch/sTfjkP8rSH+FhB/4m+HIf7E345D/K0h/hYQf+JvhyH+xN+OQ/ytIf4WEH/ib4ch/sTfjkP8rSH+FhB/4m+HIf7E345D/K0h/hYQf+JvhyH+xN+OQ/ytcUz8U1NTFRERocjISEVGRmrLli2Wz0H8ib8dhvgTfzsO8bfGMfEfMmSIKisrf9Q5iD/xt8MQf+JvxyH+1jgi/keOHNGgQYOUnJysYcOGadGiRf+v8xB/4m+HIf7E345D/K1xRPyLioo0efJknT59WqWlpUpMTJTH47F8HuJP/O0wxJ/423GIvzWOiP+F3G630tPTLf2Z0NBQDeodqjH9meaYP/cKVWjo/2bw4MEaN24c0wwzYMAAr71OeOLXykj7OdMM4xpyp9deP/nkML344nSmGWbo0Chzn3Fxjoh/YWGh8vPzzY/dbrcyMjL8uCIAAPzHEfHftm2bEhISVFVVpYqKCiUlJamgoMDfywIAwC8cEX9JWrBggVwul2JiYpSTk+Pv5QAA4DeOiT8AAPge8QcAwGGIPwAADkP8AQBwGOIPAIDDEP8AVl5ersmTJyssLEyhoaGKiorS7t27/b0sR1i7dq3+9Kc/qXPnzvrjH/+oefPmSZI2b96s+Ph4bdiwQcOHD/fzKu2lurpaGRkZ6tmzp7p06aKePXua+94YX7fFmDFjlJeX1xxLDVh79+7V7bffrs6dO5vjcrlUXFx80ftseXm5RowYIel/93PYF/EPYDExMZo0aZLOnDkjScrNzVW3bt303Xf8byybU0lJiUJCQvT5559LkoqLixUeHq733ntPlZWV+uabb4h/M0hJSdFTTz2lr7/+WpJ04MABPfbYYxf9q7nE/3/27t2rsLAw8+Pz588rLS1NI0eOvOh99vjx4+rZs6ckmfdz2BfxD1Dbt2/XAw88oJqaGq/jbrdbx44dkyTNmjVL4eHhevjhh/Xyyy+rtrZWHo9HgwcPVmJiolwulyZOnKiamhqfxyUpMzNTkZGRevTRR5WWlmZ+fXR0tHr06KHU1NTLfv3+dOjQIXXv3l2lpaXmsR07dqioqOgHr/yfeeYZr8D069dPhYWFkthXK/773/8qJCRE5eXlXsd3796t//znP+bHDd3n626L2tpaTZs2TQ899JCioqI0aNAgx8dfkrZs2aJHHnnE3Keamho999xz6t+/v3r06KG4uDidO3dOo0aN0p133qm//vWv5v3c4/HoySef1NNPP62BAwdq5MiRqq6u/sETibonWh6PRzExMUpISFD//v01Y8YMvfzyyxo2bJgGDBjg9d8U/Iv4B6jFixcrMTHR5+fXr1+vQYMGqaqqStXV1XK5XFq+fLk8Ho+6d++u06dPS5KSk5P19ttv+zy+detWxcbGqrq6WrW1tUpNTVV2drY8Ho9CQ0NVWlqqs2fPXpZrDiQZGRkKDQ1VfHy85s6da74avTD+69atMx8EDxw4oPDwcEliXy1asWLFRX/M7Os+X3db5OXlKSoqSjU1NTp58qS6du3q+PiXl5dr3LhxSk1NNfepoKBAzz77rKTvfzLwl7/8Re+//77XK//68e/WrZv5uBEVFaWNGzc2Gv/u3burrKxMVVVVuueee/Tuu+9KkiZOnKilS5derq3ARRD/ALVkyRLz928NmTJlihYuXGh+vHr1aqWkpMjj8Wj06NHm8ZUrV2rs2LE+j6enpyssLEwRERGKiIhQnz59NG3aNPMZvJOVl5drw4YNmj59urp3767169f/IP7nzp1TWFiYzpw5o4yMDM2ZM0eS2FeLLoz/v/71L3Xp0kX33nuvevfuLcn3fb7utpg0aZIWLFhgfj4lJcWR8b/99tvVpUsXdenSRSEhIUpMTNTJkye9gr1//35lZWVpypQpCgsL0+rVq33G3+VymeefMGGCVq1a1Wj84+LizONhYWE6ceKEJOkf//iH/vnPf16ObUATEP8AtXPnTj344IM6f/681/GpU6dq8+bNSktL83ogzM3N1ahRo+TxeDRq1Cjz+LJlyzR+/Hifx19++WW9+uqr5vGysjKdPn1aHo+n0Z882NmGDRu8IiJ9v78ul6vBN/w999xzWrVqlR5++GEVFxdLEvtq0VdffaWQkBBVVFR4Hd+7d68efPBBSfJ5n6+7LdLS0vTWW2+Zn58wYYIj43/hj/3r1O3Txo0b1bt3by1ZskQFBQUaMWKEcnNzfca//v11woQJWrlypd5//30lJSWZx0eOHGnGv/7Xh4WF6dtvv5VE/AMN8Q9gUVFRSktLU3l5uc6fP6/ly5erW7duKikp0bvvvvuDH4EuXrxYHo9HISEhOnHihKqrqxUVFaXVq1f7PL5p0yb16tVLZWVlqqmp8TqPUyNVWFiorl276sMPP1RlZaVOnjypkSNHatq0aQ3GPz8/X5GRkRoyZIh5DvbVujFjxsjlcmnv3r06f/68Dh48qBkzZpi/SvF1n6+7LdavX6/HH39cZ8+eVVlZmR544AHiX0/dPk2bNs38J82PHTumsLAwrVq1St9++63uv/9+SReP//bt2/XQQw+purpax44d0+9+9zvif4Uh/gGsrKxMY8eOVffu3RUSEqKoqCjt2rXL/Pyrr76qhx9+WL1799a0adPMN5TVhah379566aWXzDcCNnRckt58802Fh4crPDxcL7zwgnkeJ0cqLy9PjzzyiO666y6FhIRo4sSJqqio8PlX/Xr06KHs7Gyvc7Cv1tTU1Oi1115Tnz59dNddd+n+++9XWlqajh8/bn5NQ/f5+rdFenq6HnroIQ0ePFhPPvkk8a+nbp++/PJLRUREKCoqSs8884zGjx+vWbNm6fz58xo8eLDCw8MvGv/a2lqlpKToD3/4g6Kjo71+7E/8rwzE32Z8xYXoAADqEH+bIf4AgIsh/gAAOAzxBwDAYYg/AAAOQ/wBAHAY4g8AgMMQfwAAHIb4AwDgMMQfAACHIf4AADgM8QcAwGGIPwAADkP8AQBwGOIPAIDDEH8AAByG+AMA4DDEHwAAhyH+AAA4DPEHAMBhiD8AAA5D/AEAcJj/Ax6dPc6fKg0/AAAAAElFTkSuQmCC" />';
        }
        else if($sReturnType == 'html')
        {
            $aTplData['args'] = array(
                '_t' => $sChartType,
                '_w' => $this->aData['width'],
                '_h' => $this->aData['height'],
                '_o' => json_encode($this->aData['options']),
                '_d' => json_encode($this->aData['data']),
                'unique_id' => substr(md5(rand()), 0, 8)
            );

            return \Utility\SmartyTemplate::fetchTemplate('chart.tpl', $aTplData);
        }

    }

}