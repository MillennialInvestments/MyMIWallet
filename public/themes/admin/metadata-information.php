<?php
    // Define Alert Categories
    if ($pageURIC === 'Equity-Trade') {
        $category 	= 'Equity Trade';
    } elseif ($pageURIC === 'Option-Trade') {
        $category 	= 'Option Trade';
    }
    // Define Page Titles
    if ($pageURIA === 'admin') {
        echo '<title>MyMI Dashboard</title>';
    } elseif ($pageURIA === 'Accounting') {
        echo '<title>MyMI Finance Management</title>';
    } elseif ($pageURIA === 'Alerts') {
        if ($pageURIB === 'Overview') {
            $addOn = 'Alert Overview';
            echo '<title>' . $addOn . '</title>';
        } elseif ($pageURIB === 'Performance-Overviewe') {
            echo '<title>Alert Performance Overview</title>';
        } elseif ($pageURIB === 'Search') {
            $addOn = 'Search Stocks & ETFs | ';
            echo '<title>' . $addOn . 'Alert Management</title>';
        } elseif ($pageURIB === 'Summary') {
            $addOn = ' | Stock Summary';
            echo '<title>' . $pageURIC .  $addOn . '</title>';
        } elseif ($pageURIB === 'Add') {
            $addOn = $pageURID . ' | ' . $category;
            echo '<title>' . $addOn . '</title>';
        } elseif ($pageURIB === 'Update') {
            $addOn = $pageURID . ' | ' . $category;
            echo '<title>' . $addOn . '</title>';
        } elseif ($pageURIB === 'Close') {
            $addOn = $pageURID . ' | ' . $category;
            echo '<title>' . $addOn . '</title>';
        } elseif ($pageURIB === 'Price-Targets') {
            $addOn = ' | Price Targets';
            echo '<title>Alert Management' . $addOn . '</title>';
        } elseif ($pageURIB === 'Daily-Watchlist') {
            $addOn = ' | Price Targets';
            echo '<title>Alert Management' . $addOn . '</title>';
        } elseif ($pageURIB === 'Status-Update') {
            echo '<title>Alert Status Update</title>';
        } else {
            $addOn = '';
            echo '<title>Alert Management' . $addOn . '</title>';
        }
    } elseif ($pageURIA === 'Alert-Procedures') {
        if ($pageURIB === 'Breakout-Stocks' or $pageURIB === 'Liquidity-Stocks' or $pageURIB === 'Morning-Movers' or $pageURIB === 'Penny-Stocks' or $pageURIB === 'Weekly Options') {
        }
        if ($pageURIB === 'Breakout-Stocks') {
            $category 	= 'Breakout Stock';
        } elseif ($pageURIB === 'Update-Breakout-Stocks') {
            $category	= 'Update Breakout Stock';
        } elseif ($pageURIB === 'Close-Breakout-Stocks') {
            $category	= 'Close Breakout Stock';
        } elseif ($pageURIB === 'Liquidity-Stocks') {
            $category 	= 'Liquidity Stock';
        } elseif ($pageURIB === 'Update-Liquidity-Stocks') {
            $category	= 'Update Liquidity Stock';
        } elseif ($pageURIB === 'Close-Liquidity-Stocks') {
            $category	= 'Close Liquidity Stock';
        } elseif ($pageURIB === 'Morning-Movers') {
            $category 	= 'Morning Mover';
        } elseif ($pageURIB === 'Update-Morning-Movers') {
            $category	= 'Update Morning Mover';
        } elseif ($pageURIB === 'Close-Morning-Movers') {
            $category	= 'Close Morning Mover';
        } elseif ($pageURIB === 'Penny-Stocks') {
            $category 	= 'Penny Stock';
        } elseif ($pageURIB === 'Update-Penny-Stocks') {
            $category	= 'Update Penny Stock';
        } elseif ($pageURIB === 'Close-Penny-Stocks') {
            $category	= 'Close Penny Stock';
        } elseif ($pageURIB === 'Weekly-Option') {
            $category 	= 'Weekly Option';
        } elseif ($pageURIB === 'Update-Weekly-Option') {
            $category	= 'Update Weekly Option';
        } elseif ($pageURIB === 'Close-Weekly-Option') {
            $category	= 'Close Weekly Option';
        }
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('id', $pageURIC);
        $getSymbolInfo	= $this->db->get();
        
        foreach ($getSymbolInfo->result_array() as $symInfo) {
            echo '<title>' . $symInfo['stock'] . ' | Promote ' . $category . ' Alert</title>';
        }
    } elseif ($pageURIA === 'Email-Management') {
        echo '<title>Email Management</title>';
    } elseif ($pageURIA === 'Marketing') {
        echo '<title>Email Management</title>';
    } elseif ($pageURIA === 'Trading-Log') {
        echo '<title>Daily SPY Trading Log</title>';
    } elseif ($pageURIA === 'Web-Design') {
        echo '<title>Website Management</title>';
    } elseif ($pageURIA === 'Breakout-Stocks' or $pageURIA === 'Liquidity-Stocks' or $pageURIA === 'Morning-Movers' or $pageURIA === 'Penny-Stocks') {
        echo '
		<link rel="pre-fetch" href="api.tdameritrade.com">
		<link rel="pre-fetch" href="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" as="script">   
		<link rel="pre-fetch" href="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" as="script">   
		';
    } elseif ($pageURIA === 'Free-Users') {
        echo '<title>Free User Management</title>';
    } elseif ($pageURIA === 'All-Users') {
        echo '<title>All User Management</title>';
    } elseif ($pageURIA === 'Basic-Users') {
        echo '<title>Basic User Management</title>';
    } elseif ($pageURIA === 'Premium-Users') {
        echo '<title>Premium User Management</title>';
    } elseif ($pageURIA === 'Gold-Users') {
        echo '<title>Gold User Management</title>';
    } elseif ($pageURIA === 'Inactive-Users') {
        echo '<title>Inactive User Management</title>';
    } elseif ($pageURIA === 'Membership-Cancellations') {
        echo '<title>Membership Cancellations Management</title>';
    } elseif ($pageURIA === 'Membership-Downgrades') {
        echo '<title>Membership Downgrades Management</title>';
    } elseif ($pageURIA === 'Membership-Upgrades') {
        echo '<title>Membership Upgrades Management</title>';
    } elseif ($pageURIA === 'Customer-Support' and $pageURIB === 'Requests') {
        echo '<title>Customer Service Requests</title>';
    } elseif ($pageURIA === 'Referral-Program' and $pageURIB === 'Apply') {
        echo '<title>Dashboard | Referral Program</title>';
    } elseif ($pageURIA === 'Referral-Program') {
        echo '<title>Apply Now | Referral Program</title>';
    } elseif ($pageURIA === 'Referral-Program' and $pageURIB === 'Applications') {
        echo '<title>Applications | Referral Program</title>';
    } elseif ($pageURIA === 'Referral-Program' and $pageURIB === 'Affiliates') {
        echo '<title>Affiliates | Referral Program</title>';
    } elseif ($pageURIA === 'Referral-Program' and $pageURIB === 'New-Affiliate-Information') {
        echo '<title>New Affiliate Information | Referral Program</title>';
    } elseif ($pageURIA === 'Referral-Program' and $pageURIB === 'Marketing-Affiliate-Program-Agreement') {
        echo '<title>Marketing Affiliate Program Agreement | Referral Program</title>';
    } elseif ($pageURIA === 'Breakout-Stocks') {
        echo '<title>Alerts | Breakout Stocks</title>';
    } elseif ($pageURIA === 'Liquidity-Stocks') {
        echo '<title>Alerts | Liquidity Stocks</title>';
    } elseif ($pageURIA === 'Morning-Movers') {
        echo '<title>Alerts | Morning Movers</title>';
    } elseif ($pageURIA === 'Penny-Stocks') {
        echo '<title>Alerts | Penny Stocks</title>';
    } elseif ($pageURIA === 'Weekly-Options') {
        echo '<title>Alerts | Weekly Options</title>';
    } else {
    }
