<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\Usage;

class UpdateAdStatusService
{
    public function validate(Ad $ad)
    {
        $isOwner = auth()->id() == $ad->user_id;
        $isAdmin = auth()->user()->role == 'admin';

        if (!$isAdmin && !$isOwner) {
            return response()->json(['message' => 'Unauthorized action', 'code' => 401], 401);
        }

        return true;
    }

    public function updateToDraft(Ad $ad)
    {
        if ($this->validate($ad)) {
            $ad->status = Ad::DRAFT;
            return response()->json(['data' => $ad], 200);
        }
    }

    public function updateToPendingApproval(Ad $ad)
    {
        if ($this->validate($ad) && $ad->status == Ad::DRAFT) {
            $ad->status = Ad::PENDING_APPROVAL;
            return response()->json(['data' => $ad], 200);
        }
    }

    public function approve(Ad $ad)
    {
        if ($this->validate($ad) && $ad->status == Ad::PENDING_APPROVAL) {
            $ad->status = Ad::APPROVED;
            return response()->json(['data' => $ad], 200);
        }
    }

    public function publish(Ad $ad)
    {
        if ($this->validate($ad) && ($ad->status == Ad::PENDING_APPROVAL || $ad->status == Ad::SUSPENDED)) {
            $userUsage = Usage::where('user_id', $ad->user_id)->first();
            if ($userUsage->used < $userUsage->max_limit) {
                $userUsage->increment('used', 1);
                $ad->status = Ad::PUBLISHED;
                return response()->json(['data' => $ad], 200);
            } else {
                return response()->json(['message' => 'you reached the max limit upgrage your membership to can post more', 'code' => 400], 400);
            }
        }
    }

    public function reject(Ad $ad)
    {
        if ($this->validate($ad) && $ad->status == Ad::PENDING_APPROVAL) {
            $ad->status = Ad::REJECTED;
            return response()->json(['data' => $ad], 200);
        }
    }

    public function suspend(Ad $ad)
    {
        if ($this->validate($ad) && $ad->status == Ad::PUBLISHED) {
            $userUsage = Usage::where('user_id', $ad->user_id)->first();
            $userUsage->decrement('used', 1);
            $ad->status = Ad::SUSPENDED;
            return response()->json(['data' => $ad], 200);
        }
    }

    public function updateStatus(Ad $ad, $status)
    {
        if ($status == Ad::DRAFT) {
            return $this->updateToDraft($ad);
        } elseif ($status == Ad::PENDING_APPROVAL) {
            return $this->updateToPendingApproval($ad);
        } elseif ($status == Ad::APPROVED) {
            return $this->approve($ad);
        } elseif ($status == Ad::PUBLISHED) {
            return $this->publish($ad);
        } elseif ($status == Ad::REJECTED) {
            return $this->reject($ad);
        } elseif ($status == Ad::SUSPENDED) {
            return $this->suspend($ad);
        }
    }
}
