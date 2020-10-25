<?php

if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

require __DIR__ . '/fpdf.php';

$UHC_widths = [
    ' ' => 333,
'!' => 416,
'"' => 416,
'#' => 833,
'$' => 625,
'%' => 916,
'&' => 833,
'\'' => 250,
'(' => 500,
')' => 500,
'*' => 500,
'+' => 833,
',' => 291,
'-' => 833,
'.' => 291,
'/' => 375,
'0' => 625,
'1' => 625,
'2' => 625,
'3' => 625,
'4' => 625,
'5' => 625,
'6' => 625,
'7' => 625,
'8' => 625,
'9' => 625,
':' => 333,
';' => 333,
'<' => 833,
'=' => 833,
'>' => 916,
'?' => 500,
'@' => 1000,
'A' => 791,
'B' => 708,
'C' => 708,
'D' => 750,
'E' => 708,
'F' => 666,
'G' => 750,
'H' => 791,
'I' => 375,
'J' => 500,
'K' => 791,
'L' => 666,
'M' => 916,
'N' => 791,
'O' => 750,
'P' => 666,
'Q' => 750,
'R' => 708,
'S' => 666,
'T' => 791,
'U' => 791,
'V' => 750,
'W' => 1000,
'X' => 708,
'Y' => 708,
'Z' => 666,
'[' => 500,
'\\' => 375,
']' => 500,
'^' => 500,
'_' => 500,
'`' => 333,
'a' => 541,
'b' => 583,
'c' => 541,
'd' => 583,
'e' => 583,
'f' => 375,
'g' => 583,
'h' => 583,
'i' => 291,
'j' => 333,
'k' => 583,
'l' => 291,
'm' => 875,
'n' => 583,
'o' => 583,
'p' => 583,
'q' => 583,
'r' => 458,
's' => 541,
't' => 375,
'u' => 583,
'v' => 583,
'w' => 833,
'x' => 625,
'y' => 625,
'z' => 500,
'{' => 583,
'|' => 583,
'}' => 583,
'~' => 750,
];

class PDF_Korean extends FPDF
{
    public function AddCIDFont($family, $style, $name, $cw, $CMap, $registry)
    {
        $fontkey = mb_strtolower($family) . mb_strtoupper($style);

        if (isset($this->fonts[$fontkey])) {
            $this->Error("Font already added: $family $style");
        }

        $i = count($this->fonts) + 1;

        $name = str_replace(' ', '', $name);

        $this->fonts[$fontkey] = ['i' => $i, 'type' => 'Type0', 'name' => $name, 'up' => -130, 'ut' => 40, 'cw' => $cw, 'CMap' => $CMap, 'registry' => $registry];
    }

    public function AddCIDFonts($family, $name, $cw, $CMap, $registry)
    {
        $this->AddCIDFont($family, '', $name, $cw, $CMap, $registry);

        $this->AddCIDFont($family, 'B', $name . ',Bold', $cw, $CMap, $registry);

        $this->AddCIDFont($family, 'I', $name . ',Italic', $cw, $CMap, $registry);

        $this->AddCIDFont($family, 'BI', $name . ',BoldItalic', $cw, $CMap, $registry);
    }

    public function AddUHCFont($family = 'UHC', $name = 'HYSMyeongJoStd-Medium-Acro')
    {
        //Add UHC font with proportional Latin

        $cw = $GLOBALS['UHC_widths'];

        $CMap = 'KSCms-UHC-H';

        $registry = ['ordering' => 'Korea1', 'supplement' => 1];

        $this->AddCIDFonts($family, $name, $cw, $CMap, $registry);
    }

    public function AddUHChwFont($family = 'UHC-hw', $name = 'HYSMyeongJoStd-Medium-Acro')
    {
        //Add UHC font with half-witdh Latin

        for ($i = 32; $i <= 126; $i++) {
            $cw[chr($i)] = 500;
        }

        $CMap = 'KSCms-UHC-HW-H';

        $registry = ['ordering' => 'Korea1', 'supplement' => 1];

        $this->AddCIDFonts($family, $name, $cw, $CMap, $registry);
    }

    public function GetStringWidth($s)
    {
        if ('Type0' == $this->CurrentFont['type']) {
            return $this->GetMBStringWidth($s);
        }

        return parent::GetStringWidth($s);
    }

    public function GetMBStringWidth($s)
    {
        //Multi-byte version of GetStringWidth()

        $l = 0;

        $cw = &$this->CurrentFont['cw'];

        $nb = mb_strlen($s);

        $i = 0;

        while ($i < $nb) {
            $c = $s[$i];

            if (ord($c) < 128) {
                $l += $cw[$c];

                $i++;
            } else {
                $l += 1000;

                $i += 2;
            }
        }

        return $l * $this->FontSize / 1000;
    }

    public function MultiCell($w, $h, $txt, $border = 0, $align = 'L', $fill = 0)
    {
        if ('Type0' == $this->CurrentFont['type']) {
            $this->MBMultiCell($w, $h, $txt, $border, $align, $fill);
        } else {
            parent::MultiCell($w, $h, $txt, $border, $align, $fill);
        }
    }

    public function MBMultiCell($w, $h, $txt, $border = 0, $align = 'L', $fill = 0)
    {
        //Multi-byte version of MultiCell()

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

            //Check if ASCII or MB

            $ascii = (ord($c) < 128);

            if ("\n" == $c) {
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

            if (!$ascii) {
                $sep = $i;

                $ls = $l;
            } elseif (' ' == $c) {
                $sep = $i;

                $ls = $l;
            }

            $l += $ascii ? $cw[$c] : 1000;

            if ($l > $wmax) {
                //Automatic line break

                if (-1 == $sep or $i == $j) {
                    if ($i == $j) {
                        $i += $ascii ? 1 : 2;
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
                $i += $ascii ? 1 : 2;
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
            $this->MBWrite($h, $txt, $link);
        } else {
            parent::Write($h, $txt, $link);
        }
    }

    public function MBWrite($h, $txt, $link)
    {
        //Multi-byte version of Write()

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

            //Check if ASCII or MB

            $ascii = (ord($c) < 128);

            if ("\n" == $c) {
                //Explicit line break

                $this->Cell($w, $h, mb_substr($s, $j, $i - $j), 0, 2, '', 0, $link);

                $i++;

                $sep = -1;

                $j = $i;

                $l = 0;

                if (1 == $nl) {
                    $this->x = $this->lMargin;

                    $w = $this->w - $this->rMargin - $this->x;

                    $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
                }

                $nl++;

                continue;
            }

            if (!$ascii or ' ' == $c) {
                $sep = $i;
            }

            $l += $ascii ? $cw[$c] : 1000;

            if ($l > $wmax) {
                //Automatic line break

                if (-1 == $sep or $i == $j) {
                    if ($this->x > $this->lMargin) {
                        //Move to next line

                        $this->x = $this->lMargin;

                        $this->y += $h;

                        $w = $this->w - $this->rMargin - $this->x;

                        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;

                        $i++;

                        $nl++;

                        continue;
                    }

                    if ($i == $j) {
                        $i += $ascii ? 1 : 2;
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
                $i += $ascii ? 1 : 2;
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

        if ('KSCms-UHC-HW-H' == $font['CMap']) {
            $W = '8094 8190 500';
        } else {
            $W = '1 [' . implode(' ', $font['cw']) . ']';
        }

        $this->_out('/W [' . $W . ']>>');

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

        $this->_out('/StemV 50');

        $this->_out('>>');

        $this->_out('endobj');
    }
}
