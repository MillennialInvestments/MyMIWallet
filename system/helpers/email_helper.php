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
 * @since	Version 1.0.0
 * @filesource
 */
<<<<<<< HEAD
defined('BASEPATH') OR exit('No direct script access allowed');
=======
defined('BASEPATH') or exit('No direct script access allowed');
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283

/**
 * CodeIgniter Email Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
<<<<<<< HEAD
 * @link		https://codeigniter.com/userguide3/helpers/email_helper.html
=======
 * @link		https://codeigniter.com/user_guide/helpers/email_helper.html
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
 */

// ------------------------------------------------------------------------

<<<<<<< HEAD
if ( ! function_exists('valid_email'))
{
	/**
	 * Validate email address
	 *
	 * @deprecated	3.0.0	Use PHP's filter_var() instead
	 * @param	string	$email
	 * @return	bool
	 */
	function valid_email($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
=======
if (! function_exists('valid_email')) {
    /**
     * Validate email address
     *
     * @deprecated	3.0.0	Use PHP's filter_var() instead
     * @param	string	$email
     * @return	bool
     */
    function valid_email($email)
    {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}

// ------------------------------------------------------------------------

<<<<<<< HEAD
if ( ! function_exists('send_email'))
{
	/**
	 * Send an email
	 *
	 * @deprecated	3.0.0	Use PHP's mail() instead
	 * @param	string	$recipient
	 * @param	string	$subject
	 * @param	string	$message
	 * @return	bool
	 */
	function send_email($recipient, $subject, $message)
	{
		return mail($recipient, $subject, $message);
	}
=======
if (! function_exists('send_email')) {
    /**
     * Send an email
     *
     * @deprecated	3.0.0	Use PHP's mail() instead
     * @param	string	$recipient
     * @param	string	$subject
     * @param	string	$message
     * @return	bool
     */
    function send_email($recipient, $subject, $message)
    {
        return mail($recipient, $subject, $message);
    }
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}
