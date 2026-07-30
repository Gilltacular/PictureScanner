<?php

// Modified By: Picture Scanner project team - Original developed by Csongor
// at: http://www.phpclasses.org/browse/package/3370.html


	class GetMostCommonColors
	{
		var $PREVIEW_WIDTH    = 150;
		var $PREVIEW_HEIGHT   = 150;
		var $error;

		//Returns the colors of the image in an array, ordered in descending order
		//where the keys are the colors, and the values are the count of the color.
		function Get_Color( $img, $count=20, $reduce_brightness=true, $reduce_gradients=true, $delta=16 )
		{
			if (is_readable( $img ))
			{
				if ( $delta > 2 )
				{
					$half_delta = $delta / 2 - 1;
				}
				else
				{
					$half_delta = 0;
				}
				//RESIZE THE IMAGE BECAUSE WE ONLY NEED THE MOST SIGNIFICANT COLORS.
				$size = GetImageSize($img);
				$scale = 1;
				if ($size[0]>0)
				$scale = min($this->PREVIEW_WIDTH/$size[0], $this->PREVIEW_HEIGHT/$size[1]);
				if ($scale < 1)
				{
					$width = floor($scale*$size[0]);
					$height = floor($scale*$size[1]);
				}
				else
				{
					$width = $size[0];
					$height = $size[1];
				}
				$image_resized = imagecreatetruecolor($width, $height);
				if ($size[2] == 1)
				$image_orig = imagecreatefromgif($img);
				if ($size[2] == 2)
				$image_orig = imagecreatefromjpeg($img);
				if ($size[2] == 3)
				$image_orig = imagecreatefrompng($img);
				imagecopyresampled($image_resized, $image_orig, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
				$im = $image_resized;
				$imgWidth = imagesx($im);
				$imgHeight = imagesy($im);
				$total_pixel_count = 0;
				for ($y=0; $y < $imgHeight; $y++)
				{
					for ($x=0; $x < $imgWidth; $x++)
					{
						$total_pixel_count++;
						$index = imagecolorat($im,$x,$y);
						$colors = imagecolorsforindex($im,$index);
						if ( $delta > 1 ) //round the color reducing the number of duplicate colors
						{
							$colors['red'] = intval((($colors['red'])+$half_delta)/$delta)*$delta;
							$colors['green'] = intval((($colors['green'])+$half_delta)/$delta)*$delta;
							$colors['blue'] = intval((($colors['blue'])+$half_delta)/$delta)*$delta;
							if ($colors['red'] >= 256)
							{
								$colors['red'] = 255;
							}
							if ($colors['green'] >= 256)
							{
								$colors['green'] = 255;
							}
							if ($colors['blue'] >= 256)
							{
								$colors['blue'] = 255;
							}
						}
						$hex = substr("0".dechex($colors['red']),-2).substr("0".dechex($colors['green']),-2).substr("0".dechex($colors['blue']),-2);
						if ( ! isset( $hexarray[$hex] ) )
						{
							$hexarray[$hex] = 1;
						}
						else
						{
							$hexarray[$hex]++;
						}
					}
				}
				if ( $reduce_gradients ) // Reduce gradient colors
				{
					ksort( $hexarray );
					//arsort( $hexarray, SORT_NUMERIC );
					$gradients = array();
					foreach ($hexarray as $hex => $num)
					{
						if ( ! isset($gradients[$hex]) )
						{
							$new_hex = $this->_find_adjacent( $hex, $gradients, $delta );
							$gradients[$hex] = $new_hex;
						}
						else
						{
							$new_hex = $gradients[$hex];
						}
						if ($hex != $new_hex)
						{
							$hexarray[$hex] = 0;
							$hexarray[$new_hex] += $num;
						}
					}
				}
				if ( $reduce_brightness ) // Reduce brightness variations
				{
					ksort( $hexarray );
					//arsort( $hexarray, SORT_NUMERIC );

					$brightness = array();
					foreach ($hexarray as $hex => $num)
					{
						if ( ! isset($brightness[$hex]) )
						{
							$new_hex = $this->_normalize( $hex, $brightness, $delta );
							$brightness[$hex] = $new_hex;
						}
						else
						{
							$new_hex = $brightness[$hex];
						}
						if ($hex != $new_hex)
						{
							$hexarray[$hex] = 0;
							$hexarray[$new_hex] += $num;
						}
					}
				}
				arsort( $hexarray, SORT_NUMERIC );
				foreach ($hexarray as $key => $value) 	// convert counts to percentages
				{
					$hexarray[$key] = (float)$value / $total_pixel_count;
				}
				if ( $count > 0 )
				{
					$arr = array();
					foreach ($hexarray as $key => $value)
					{
						if ($count == 0)
						{
							break;
						}
						$count--;
						$arr[$key] = $value;
					}
					return $arr;
				}
				else
				{
					return $hexarray;
				}
			}
			else
			{
				$this->error = "Image ".$img." does not exist or is unreadable";
				return false;
			}
		}

		function _normalize( $hex, $hexarray, $delta )
		{
			$lowest = 255;
			$highest = 0;
			$colors['red'] = hexdec( substr( $hex, 0, 2 ) );
			$colors['green']  = hexdec( substr( $hex, 2, 2 ) );
			$colors['blue'] = hexdec( substr( $hex, 4, 2 ) );

			if ($colors['red'] < $lowest)
			{
				$lowest = $colors['red'];
			}
			if ($colors['green'] < $lowest )
			{
				$lowest = $colors['green'];
			}
			if ($colors['blue'] < $lowest )
			{
				$lowest = $colors['blue'];
			}
			if ($colors['red'] > $highest)
			{
				$highest = $colors['red'];
			}
			if ($colors['green'] > $highest )
			{
				$highest = $colors['green'];
			}
			if ($colors['blue'] > $highest )
			{
				$highest = $colors['blue'];
			}
			if ( $lowest == $highest ) // Do not normalize white, black, or shades of grey unless low delta
			{
				if ($delta <= 32)
				{
					if ( $lowest == 0 || $highest >= (255 - $delta) )
					{
						return $hex;
					}
				}
				else
				{
					return $hex;
				}
			}
			for (; $highest < 256; $lowest += $delta, $highest += $delta)
			{
				$new_hex = substr("0".dechex($colors['red'] - $lowest),-2).substr("0".dechex($colors['green'] - $lowest),-2).substr("0".dechex($colors['blue'] - $lowest),-2);
				if ( isset( $hexarray[$new_hex] ) )
				{
					return $new_hex;
				}
			}
			return $hex;
		}

		function _find_adjacent( $hex, $gradients, $delta )
		{
			$red = hexdec( substr( $hex, 0, 2 ) );
			$green  = hexdec( substr( $hex, 2, 2 ) );
			$blue = hexdec( substr( $hex, 4, 2 ) );

			if ($red > $delta)
			{
				$new_hex = substr("0".dechex($red - $delta),-2).substr("0".dechex($green),-2).substr("0".dechex($blue),-2);
				if ( isset($gradients[$new_hex]) )
				{
					return $gradients[$new_hex];
				}
			}
			if ($green > $delta)
			{
				$new_hex = substr("0".dechex($red),-2).substr("0".dechex($green - $delta),-2).substr("0".dechex($blue),-2);
				if ( isset($gradients[$new_hex]) )
				{
					return $gradients[$new_hex];
				}
			}
			if ($blue > $delta)
			{
				$new_hex = substr("0".dechex($red),-2).substr("0".dechex($green),-2).substr("0".dechex($blue - $delta),-2);
				if ( isset($gradients[$new_hex]) )
				{
					return $gradients[$new_hex];
				}
			}
			if ($red < (255 - $delta))
			{
				$new_hex = substr("0".dechex($red + $delta),-2).substr("0".dechex($green),-2).substr("0".dechex($blue),-2);
				if ( isset($gradients[$new_hex]) )
				{
					return $gradients[$new_hex];
				}
			}
			if ($green < (255 - $delta))
			{
				$new_hex = substr("0".dechex($red),-2).substr("0".dechex($green + $delta),-2).substr("0".dechex($blue),-2);
				if ( isset($gradients[$new_hex]) )
				{
					return $gradients[$new_hex];
				}
			}
			if ($blue < (255 - $delta))
			{
				$new_hex = substr("0".dechex($red),-2).substr("0".dechex($green),-2).substr("0".dechex($blue + $delta),-2);
				if ( isset($gradients[$new_hex]) )
				{
					return $gradients[$new_hex];
				}
			}
			return $hex;
		}
	}
?>
