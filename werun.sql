-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- 생성 시간: 17-10-16 06:47
-- 서버 버전: 5.7.19-0ubuntu0.16.04.1
-- PHP 버전: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `werun`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `boardIdx` int(11) NOT NULL,
  `comIdx` int(11) NOT NULL,
  `parentIdx` int(11) DEFAULT '0',
  `memberIdx` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `contents` text NOT NULL,
  `date` datetime NOT NULL,
  `isNotice` int(1) DEFAULT '0',
  `isDelete` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `club`
--

CREATE TABLE `club` (
  `clubIdx` int(11) NOT NULL,
  `adminIdx` int(11) NOT NULL,
  `sAdminIdx` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `addr1` text NOT NULL,
  `part` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `contents` text NOT NULL,
  `public` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `competition`
--

CREATE TABLE `competition` (
  `comIdx` int(11) NOT NULL,
  `adminIdx` int(11) NOT NULL,
  `subAdminIdx` varchar(30) NOT NULL,
  `judges` varchar(30) NOT NULL,
  `comDate` date NOT NULL,
  `applyDate` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `stadiumAddr` text NOT NULL,
  `addr` varchar(255) NOT NULL,
  `parts` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `contents` text NOT NULL,
  `public` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `department`
--

CREATE TABLE `department` (
  `depIdx` int(11) NOT NULL,
  `comIdx` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comDateS` date NOT NULL,
  `comDateE` date NOT NULL,
  `applyDateS` datetime NOT NULL,
  `applyDateE` datetime NOT NULL,
  `partIdx` int(11) NOT NULL,
  `blocks` varchar(255) NOT NULL DEFAULT 'AGE^10^up|SEX^A',
  `addr1` varchar(255) NOT NULL,
  `addr2` varchar(255) NOT NULL,
  `stadium` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `depToApplyMember`
--

CREATE TABLE `depToApplyMember` (
  `teamIdx` int(11) NOT NULL,
  `memberIdx` int(11) NOT NULL,
  `depIdx` int(11) NOT NULL,
  `permit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `game`
--

CREATE TABLE `game` (
  `gameIdx` int(11) NOT NULL,
  `depIdx` int(11) NOT NULL,
  `teamIdx` varchar(30) NOT NULL,
  `judges` varchar(30) NOT NULL,
  `gameDateS` datetime NOT NULL,
  `gameDateE` datetime NOT NULL,
  `addr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `memberIdx` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `name` varchar(60) NOT NULL,
  `nickName` varchar(60) NOT NULL,
  `birth` date NOT NULL,
  `sex` char(1) NOT NULL,
  `addr1` text NOT NULL,
  `addr2` text NOT NULL,
  `zipCode` int(6) NOT NULL,
  `phone` int(11) NOT NULL,
  `parts` varchar(30) NOT NULL,
  `public` char(1) NOT NULL,
  `permit` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`memberIdx`, `email`, `passwd`, `name`, `nickName`, `birth`, `sex`, `addr1`, `addr2`, `zipCode`, `phone`, `parts`, `public`, `permit`) VALUES
(1, 'admin@werun.pe.kr', '', '이희현', '관리자', '1992-10-24', '남', '경기도', '광주시', 12721, 1063397866, '1|2|3', '1', 0),
(2, 'sh9306@naver.com', '1234', '최성환', '가시고기', '1993-06-11', '남', '경기도', '성남시', 13360, 1029379441, '1|2|3', '1', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `menu`
--

CREATE TABLE `menu` (
  `menuId` varchar(30) NOT NULL,
  `title` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `parent` varchar(30) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `parts`
--

CREATE TABLE `parts` (
  `partIdx` int(11) NOT NULL,
  `name` text NOT NULL,
  `population` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `parts`
--

INSERT INTO `parts` (`partIdx`, `name`, `population`) VALUES
(1, '야구', 21),
(2, '배드민턴 단식', 1),
(3, '배드민턴 복식', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `score`
--

CREATE TABLE `score` (
  `scoreIdx` varchar(30) NOT NULL,
  `memberIdxs` int(11) NOT NULL,
  `teamIdx` int(11) NOT NULL,
  `clubIdx` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `team`
--

CREATE TABLE `team` (
  `teamIdx` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `teamWeight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`boardIdx`),
  ADD KEY `memberIdx` (`memberIdx`),
  ADD KEY `parentIdx` (`parentIdx`),
  ADD KEY `comIdx` (`comIdx`);

--
-- 테이블의 인덱스 `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`clubIdx`),
  ADD UNIQUE KEY `adminIdx` (`adminIdx`);

--
-- 테이블의 인덱스 `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`comIdx`),
  ADD UNIQUE KEY `adminIdx` (`adminIdx`);

--
-- 테이블의 인덱스 `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depIdx`),
  ADD KEY `comIdx` (`comIdx`);

--
-- 테이블의 인덱스 `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameIdx`),
  ADD KEY `depIdx` (`depIdx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberIdx`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 테이블의 인덱스 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`);

--
-- 테이블의 인덱스 `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`partIdx`);

--
-- 테이블의 인덱스 `score`
--
ALTER TABLE `score`
  ADD KEY `teamIdx` (`teamIdx`),
  ADD KEY `clubIdx` (`clubIdx`);

--
-- 테이블의 인덱스 `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamIdx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `boardIdx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `club`
--
ALTER TABLE `club`
  MODIFY `clubIdx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `competition`
--
ALTER TABLE `competition`
  MODIFY `comIdx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `department`
--
ALTER TABLE `department`
  MODIFY `depIdx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `game`
--
ALTER TABLE `game`
  MODIFY `gameIdx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `memberIdx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 테이블의 AUTO_INCREMENT `parts`
--
ALTER TABLE `parts`
  MODIFY `partIdx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 테이블의 AUTO_INCREMENT `team`
--
ALTER TABLE `team`
  MODIFY `teamIdx` int(11) NOT NULL AUTO_INCREMENT;
--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `board`
--
ALTER TABLE `board`
  ADD CONSTRAINT `board_ibfk_1` FOREIGN KEY (`memberIdx`) REFERENCES `member` (`memberIdx`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`adminIdx`) REFERENCES `member` (`memberIdx`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `competition_ibfk_1` FOREIGN KEY (`adminIdx`) REFERENCES `member` (`memberIdx`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`comIdx`) REFERENCES `competition` (`comIdx`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`depIdx`) REFERENCES `department` (`depIdx`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
