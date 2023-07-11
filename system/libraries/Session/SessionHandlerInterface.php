<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
<<<<<<< HEAD
 * Copyright (c) 2019 - 2022, CodeIgniter Foundation
=======
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
<<<<<<< HEAD
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @copyright	Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com/)
 * @license	https://opensource.org/licenses/MIT	MIT License
=======
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 * @link	https://codeigniter.com
 * @since	Version 3.0.0
 * @filesource
 */
<<<<<<< HEAD
defined('BASEPATH') OR exit('No direct script access allowed');
=======
defined('BASEPATH') or exit('No direct script access allowed');
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

/**
 * SessionHandlerInterface
 *
 * PHP 5.4 compatibility interface
 *
 * @package	CodeIgniter
 * @subpackage	Libraries
 * @category	Sessions
 * @author	Andrey Andreev
<<<<<<< HEAD
 * @link	https://codeigniter.com/userguide3/libraries/sessions.html
 */
interface SessionHandlerInterface {

	public function open($save_path, $name);
	public function close();
	public function read($session_id);
	public function write($session_id, $session_data);
	public function destroy($session_id);
	public function gc($maxlifetime);
=======
 * @link	https://codeigniter.com/user_guide/libraries/sessions.html
 */
interface SessionHandlerInterface
{
    public function open($save_path, $name);
    public function close();
    public function read($session_id);
    public function write($session_id, $session_data);
    public function destroy($session_id);
    public function gc($maxlifetime);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}
