<?php

if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

require __DIR__ . '/fpdf.php';

$SJIS_widths = [
    ' ' => 278,
'!' => 299,
'"' => 353,
'#' => 614,
'$' => 614,
'%' => 721,
'&' => 735,
'\'' => 216,
'(' => 323,
')' => 323,
'*' => 449,
'+' => 529,
',' => 219,
'-' => 306,
'.' => 219,
'/' => 453,
'0' => 614,
'1' => 614,
'2' => 614,
'3' => 614,
'4' => 614,
'5' => 614,
'6' => 614,
'7' => 614,
'8' => 614,
'9' => 614,
':' => 219,
';' => 219,
'<' => 529,
'=' => 529,
'>' => 529,
'?' => 486,
'@' => 744,
'A' => 646,
'B' => 604,
'C' => 617,
'D' => 681,
'E' => 567,
'F' => 537,
'G' => 647,
'H' => 738,
'I' => 320,
'J' => 433,
'K' => 637,
'L' => 566,
'M' => 904,
'N' => 710,
'O' => 716,
'P' => 605,
'Q' => 716,
'R' => 623,
'S' => 517,
'T' => 601,
'U' => 690,
'V' => 668,
'W' => 990,
'X' => 681,
'Y' => 634,
'Z' => 578,
'[' => 316,
'\\' => 614,
']' => 316,
'^' => 529,
'_' => 500,
'`' => 387,
'a' => 509,
'b' => 566,
'c' => 478,
'd' => 565,
'e' => 503,
'f' => 337,
'g' => 549,
'h' => 580,
'i' => 275,
'j' => 266,
'k' => 544,
'l' => 276,
'm' => 854,
'n' => 579,
'o' => 550,
'p' => 578,
'q' => 566,
'r' => 410,
's' => 444,
't' => 340,
'u' => 575,
'v' => 512,
'w' => 760,
'x' => 503,
'y' => 529,
'z' => 453,
'{' => 326,
'|' => 380,
'}' => 326,
'~' => 387,
];

class PDF_Japanese extends FPDF
{
    public function AddCIDFont($family, $style, $name, $cw, $CMap, $registry)
    {
        $fontkey = mb_strtolower($family) . mb_strtoupper($style);

        if (isset($this->fonts[$fontkey])) {
            $this->Error("CID font already added: $family $style");
        }

        $i = count($this->fonts) + 1;

        $this->fonts[$fontkey] = ['i' => $i, 'type' => 'Type0', 'name' => $name, 'up' => -120, 'ut' => 40, 'cw' => $cw, 'CMap' => $CMap, 'registry' => $registry];
    }

    public function AddCIDFonts($family, $name, $cw, $CMap, $registry)
    {
        $this->AddCIDFont($family, '', $name, $cw, $CMap, $registry);

        $this->AddCIDFont($family, 'B', $name . ',Bold', $cw, $CMap, $registry);

        $this->AddCIDFont($family, 'I', $name . ',Italic', $cw, $CMap, $registry);

        $this->AddCIDFont($family, 'BI', $name . ',BoldItalic', $cw, $CMap, $registry);
    }

    public function AddSJISFont($family = 'SJIS')
    {
        //Add SJIS font with proportional Latin

        $name = 'KozMinPro-Regular-Acro';

        $cw = $GLOBALS['SJIS_widths'];

        $CMap = '90msp-RKSJ-H';

        $registry = ['ordering' => 'Japan1', 'supplement' => 2];

        $this->AddCIDFonts($family, $name, $cw, $CMap, $registry);
    }

    public function AddSJIShwFont($family = 'SJIS-hw')
    {
        //Add SJIS font with half-width Latin

        $name = 'KozMinPro-Regular-Acro';

        for ($i = 32; $i <= 126; $i++) {
            $cw[chr($i)] = 500;
        }

        $CMap = '90ms-RKSJ-H';

        $registry = ['ordering' => 'Japan1', 'supplement' => 2];

        $this->AddCIDFonts($family, $name, $cw, $CMap, $registry);
    }

    public function GetStringWidth($s)
    {
        if ('Type0' == $this->CurrentFont['type']) {
            return $this->GetSJISStringWidth($s);
        }

        return parent::GetStringWidth($s);
    }

    public function GetSJISStringWidth($s)
    {
        //SJIS version of GetStringWidth()

        $l = 0;

        $cw = &$this->CurrentFont['cw'];

        $nb = mb_strlen($s);

        $i = 0;

        while ($i < $nb) {
            $o = ord($s[$i]);

            if ($o < 128) {
                //ASCII

                $l += $cw[$s[$i]];

                $i++;
            } elseif ($o >= 161 and $o <= 223) {
                //Half-width katakana

                $l += 500;

                $i++;
            } else {
                //Full-width character

                $l += 1000;

                $i += 2;
            }
        }

        return $l * $this->FontSize / 1000;
    }

    public function MultiCell($w, $h, $txt, $border = 0, $align = 'L', $fill = 0)
    {
        if ('Type0' == $this->CurrentFont['type']) {
            $this->SJISMultiCell($w, $h, $txt, $border, $align, $fill);
        } else {
            parent::MultiCell($w, $h, $txt, $border, $align, $fill);
        }
    }

    public function SJISMultiCell($w, $h, $txt, $border = 0, $align = 'L', $fill = 0)
    {
        //Output text with automatic or explicit line breaks

        $cw = &$this->CurrentFont['cw'];

        if (0 == $w) {
            $w = $this->w - $this->rMargin - $this->x;
        }

        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;

        $s = str_replace("\r", '', $txt);

        $nb = mb_strlen($s);

        if ($nb > 0 and "\n" == $s[$nb - 1]) {
            $nb--;
        }

        $b = 0;

        if ($border) {
            if (1 == $border) {
                $border = 'LTRB';

                $b = 'LRT';

                $b2 = 'LR';
            } else {
                $b2 = '';

                if (is_int(mb_strpos($border, 'L'))) {
                    $b2 .= 'L';
                }

                if (is_int(mb_strpos($border, 'R'))) {
                    $b2 .= 'R';
                }

                $b = is_int(mb_strpos($border, 'T')) ? $b2 . 'T' : $b2;
            }
        }

        $sep = -1;

        $i = 0;

        $j = 0;

        $l = 0;

        $nl = 1;

        while ($i < $nb) {
            //Get next character

            $c = $s[$i];

            $o = ord($c);

            if (10 == $o) {
                //Explicit line break

                $this->Cell($w, $h, mb_substr($s, $j, $i - $j), $b, 2, $align, $fill);

                $i++;

                $sep = -1;

                $j = $i;

                $l = 0;

                $nl++;

                if ($border and 2 == $nl) {
                    $b = $b2;
                }

                continue;
            }

            if ($o < 128) {
                //ASCII

                $l += $cw[$c];

                $n = 1;

                if (32 == $o) {
                    $sep = $i;
                }
            } elseif ($o >= 161 and $o <= 223) {
                //Half-width katakana

                $l += 500;

                $n = 1;

                $sep = $i;
            } else {
                //Full-width character

                $l += 1000;

                $n = 2;

                $sep = $i;
            }

            if ($l > $wmax) {
                //Automatic line break

                if (-1 == $sep or $i == $j) {
                    if ($i == $j) {
                        $i += $n;
                    }

                    $this->Cell($w, $h, mb_substr($s, $j, $i - $j), $b, 2, $align, $fill);
                } else {
                    $this->Cell($w, $h, mb_substr($s, $j, $sep - $j), $b, 2, $align, $fill);

                    $i = (' ' == $s[$sep]) ? $sep + 1 : $sep;
                }

                $sep = -1;

                $j = $i;

                $l = 0;

                $nl++;

                if ($border and 2 == $nl) {
                    $b = $b2;
                }
            } else {
                $i += $n;

                if ($o >= 128) {
                    $sep = $i;
                }
            }
        }

        //Last chunk

        if ($border and is_int(mb_strpos($border, 'B'))) {
            $b .= 'B';
        }

        $this->Cell($w, $h, mb_substr($s, $j, $i - $j), $b, 2, $align, $fill);

        $this->x = $this->lMargin;
    }

    public function Write($h, $txt, $link = '')
    {
        if ('Type0' == $this->CurrentFont['type']) {
            $this->SJISWrite($h, $txt, $link);
        } else {
            parent::Write($h, $txt, $link);
        }
    }

    public function SJISWrite($h, $txt, $link)
    {
        //SJIS version of Write()

        $cw = &$this->CurrentFont['cw'];

        $w = $this->w - $this->rMargin - $this->x;

        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;

        $s = str_replace("\r", '', $txt);

        $nb = mb_strlen($s);

        $sep = -1;

        $i = 0;

        $j = 0;

        $l = 0;

        $nl = 1;

        while ($i < $nb) {
            //Get next character

            $c = $s[$i];

            $o = ord($c);

            if (10 == $o) {
                //Explicit line break

                $this->Cell($w, $h, mb_substr($s, $j, $i - $j), 0, 2, '', 0, $link);

                $i++;

                $sep = -1;

                $j = $i;

                $l = 0;

                if (1 == $nl) {
                    //Go to left margin

                    $this->x = $this->lMargin;

                    $w = $this->w - $this->rMargin - $this->x;

                    $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
                }

                $nl++;

                continue;
            }

            if ($o < 128) {
                //ASCII

                $l += $cw[$c];

                $n = 1;

                if (32 == $o) {
                    $sep = $i;
                }
            } elseif ($o >= 161 and $o <= 223) {
                //Half-width katakana

                $l += 500;

                $n = 1;

                $sep = $i;
            } else {
                //Full-width character

                $l += 1000;

                $n = 2;

                $sep = $i;
            }

            if ($l > $wmax) {
                //Automatic line break

                if (-1 == $sep or $i == $j) {
                    if ($this->x > $this->lMargin) {
                        //Move to next line

                        $this->x = $this->lMargin;

                        $this->y += $h;

                        $w = $this->w - $this->rMargin - $this->x;

                        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;

                        $i += $n;

                        $nl++;

                        continue;
                    }

                    if ($i == $j) {
                        $i += $n;
                    }

                    $this->Cell($w, $h, mb_substr($s, $j, $i - $j), 0, 2, '', 0, $link);
                } else {
                    $this->Cell($w, $h, mb_substr($s, $j, $sep - $j), 0, 2, '', 0, $link);

                    $i = (' ' == $s[$sep]) ? $sep + 1 : $sep;
                }

                $sep = -1;

                $j = $i;

                $l = 0;

                if (1 == $nl) {
                    $this->x = $this->lMargin;

                    $w = $this->w - $this->rMargin - $this->x;

                    $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
                }

                $nl++;
            } else {
                $i += $n;

                if ($o >= 128) {
                    $sep = $i;
                }
            }
        }

        //Last chunk

        if ($i != $j) {
            $this->Cell($l / 1000 * $this->FontSize, $h, mb_substr($s, $j, $i - $j), 0, 0, '', 0, $link);
        }
    }

    public function _putfonts()
    {
        $nf = $this->n;

        foreach ($this->diffs as $diff) {
            //Encodings

            $this->_newobj();

            $this->_out('<</Type /Encoding /BaseEncoding /WinAnsiEncoding /Differences [' . $diff . ']>>');

            $this->_out('endobj');
        }

        $mqr = get_magic_quotes_runtime();

        set_magic_quotes_runtime(0);

        foreach ($this->FontFiles as $file => $info) {
            //Font file embedding

            $this->_newobj();

            $this->FontFiles[$file]['n'] = $this->n;

            if (defined('FPDF_FONTPATH')) {
                $file = FPDF_FONTPATH . $file;
            }

            $size = filesize($file);

            if (!$size) {
                $this->Error('Font file not found');
            }

            $this->_out('<</Length ' . $size);

            if ('.z' == mb_substr($file, -2)) {
                $this->_out('/Filter /FlateDecode');
            }

            $this->_out('/Length1 ' . $info['length1']);

            if (isset($info['length2'])) {
                $this->_out('/Length2 ' . $info['length2'] . ' /Length3 0');
            }

            $this->_out('>>');

            $f = fopen($file, 'rb');

            $this->_putstream(fread($f, $size));

            fclose($f);

            $this->_out('endobj');
        }

        set_magic_quotes_runtime($mqr);

        foreach ($this->fonts as $k => $font) {
            //Font objects

            $this->_newobj();

            $this->fonts[$k]['n'] = $this->n;

            $this->_out('<</Type /Font');

            if ('Type0' == $font['type']) {
                $this->_putType0($font);
            } else {
                $name = $font['name'];

                $this->_out('/BaseFont /' . $name);

                if ('core' == $font['type']) {
                    //Standard font

                    $this->_out('/Subtype /Type1');

                    if ('Symbol' != $name and 'ZapfDingbats' != $name) {
                        $this->_out('/Encoding /WinAnsiEncoding');
                    }
                } else {
                    //Additional font

                    $this->_out('/Subtype /' . $font['type']);

                    $this->_out('/FirstChar 32');

                    $this->_out('/LastChar 255');

                    $this->_out('/Widths ' . ($this->n + 1) . ' 0 R');

                    $this->_out('/FontDescriptor ' . ($this->n + 2) . ' 0 R');

                    if ($font['enc']) {
                        if (isset($font['diff'])) {
                            $this->_out('/Encoding ' . ($nf + $font['diff']) . ' 0 R');
                        } else {
                            $this->_out('/Encoding /WinAnsiEncoding');
                        }
                    }
                }

                $this->_out('>>');

                $this->_out('endobj');

                if ('core' != $font['type']) {
                    //Widths

                    $this->_newobj();

                    $cw = &$font['cw'];

                    $s = '[';

                    for ($i = 32; $i <= 255; $i++) {
                        $s .= $cw[chr($i)] . ' ';
                    }

                    $this->_out($s . ']');

                    $this->_out('endobj');

                    //Descriptor

                    $this->_newobj();

                    $s = '<</Type /FontDescriptor /FontName /' . $name;

                    foreach ($font['desc'] as $k => $v) {
                        $s .= ' /' . $k . ' ' . $v;
                    }

                    $file = $font['file'];

                    if ($file) {
                        $s .= ' /FontFile' . ('Type1' == $font['type'] ? '' : '2') . ' ' . $this->FontFiles[$file]['n'] . ' 0 R';
                    }

                    $this->_out($s . '>>');

                    $this->_out('endobj');
                }
            }
        }
    }

    public function _putType0($font)
    {
        //Type0

        $this->_out('/Subtype /Type0');

        $this->_out('/BaseFont /' . $font['name'] . '-' . $font['CMap']);

        $this->_out('/Encoding /' . $font['CMap']);

        $this->_out('/DescendantFonts [' . ($this->n + 1) . ' 0 R]');

        $this->_out('>>');

        $this->_out('endobj');

        //CIDFont

        $this->_newobj();

        $this->_out('<</Type /Font');

        $this->_out('/Subtype /CIDFontType0');

        $this->_out('/BaseFont /' . $font['name']);

        $this->_out('/CIDSystemInfo <</Registry (Adobe) /Ordering (' . $font['registry']['ordering'] . ') /Supplement ' . $font['registry']['supplement'] . '>>');

        $this->_out('/FontDescriptor ' . ($this->n + 1) . ' 0 R');

        $W = '/W [1 [';

        foreach ($font['cw'] as $w) {
            $W .= $w . ' ';
        }

        $this->_out($W . '] 231 325 500 631 [500] 326 389 500]');

        $this->_out('>>');

        $this->_out('endobj');

        //Font descriptor

        $this->_newobj();

        $this->_out('<</Type /FontDescriptor');

        $this->_out('/FontName /' . $font['name']);

        $this->_out('/Flags 6');

        $this->_out('/FontBBox [0 -200 1000 900]');

        $this->_out('/ItalicAngle 0');

        $this->_out('/Ascent 800');

        $this->_out('/Descent -200');

        $this->_out('/CapHeight 800');

        $this->_out('/StemV 60');

        $this->_out('>>');

        $this->_out('endobj');
    }
}
